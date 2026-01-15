<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('pages.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {

        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');

            $path = 'profile/' . uniqid() . '.jpg';

            $imageData = $this->compressImage($file->getPathname(), 80);
            if ($imageData) {
                Storage::disk('public')->put($path, $imageData);

                if ($request->user()->profile_photo) {
                    Storage::disk('public')->delete($request->user()->profile_photo);
                }

                $data['profile_photo'] = $path;
            }
        }

        elseif ($request->filled('photo_base64')) {
            $base64 = $request->input('photo_base64');
            if (preg_match('/^data:(image\/[^;]+);base64,(.*)$/', $base64, $matches)) {
                $mime = $matches[1];
                $dataEncoded = $matches[2];
                $decoded = base64_decode($dataEncoded);
                if ($decoded !== false) {
                    $path = 'profile/' . uniqid() . '.jpg';
                    Storage::disk('public')->put($path, $decoded);

                    if ($request->user()->profile_photo) {
                        Storage::disk('public')->delete($request->user()->profile_photo);
                    }

                    $data['profile_photo'] = $path;
                }
            }
        }

        $request->user()->fill($data);

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('success', 'Perubahan profil berhasil disimpan.');
    }

    /**
     * Compress an image file to JPEG and return binary data.
     * Uses GD functions to load and re-encode the image.
     */
    protected function compressImage(string $sourcePath, int $quality = 80): ?string
    {
        $info = getimagesize($sourcePath);
        if (! $info) {
            return null;
        }

        $mime = $info['mime'];

        switch ($mime) {
            case 'image/jpeg':
            case 'image/jpg':
                $img = imagecreatefromjpeg($sourcePath);
                break;
            case 'image/png':
                $img = imagecreatefrompng($sourcePath);
                $tmp = imagecreatetruecolor(imagesx($img), imagesy($img));
                imagecopy($tmp, $img, 0, 0, 0, 0, imagesx($img), imagesy($img));
                imagedestroy($img);
                $img = $tmp;
                break;
            case 'image/gif':
                $img = imagecreatefromgif($sourcePath);
                break;
            default:
                return null;
        }

        if (! $img) {
            return null;
        }

        ob_start();
        imagejpeg($img, null, $quality);
        $data = ob_get_clean();
        imagedestroy($img);

        return $data;
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
