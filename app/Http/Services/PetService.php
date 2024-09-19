<?php

namespace App\Http\Services;

use App\Jobs\SendEmailJob;
use App\Mail\FounderMail;
use App\Mail\TagMail;
use App\Models\Image;
use App\Models\Pet;
use App\Models\TagHistory;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class PetService
{
    public static function createPetToken($data_length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $data_length; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

    public static function validate($request)
    {
        $validation = $request->validated();

        $validation['token'] = self::createPetToken(30);

        $validation['puppy'] = $request->has('puppy') ? 1 : 0;
        $validation['sterilised'] = $request->has('sterilised') ? 1 : 0;
        $validation['vaccinated'] = $request->has('vaccinated') ? 1 : 0;
        $validation['socialized'] = $request->has('socialized') ? 1 : 0;
        $validation['reward'] = $request->has('reward') ? 1 : 0;

        return $validation;
    }

    public static function storePetImage($request, $pet)
    {
        if ($request->has('image')) {
            $img_validation = $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10048',
            ]);

            if ($pet->image) {
                $image_path = public_path() . '/images/' . $pet->image->filename;
                unlink($image_path);

                $image = Image::find($pet->image->id)->delete();
            }

            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('images'), $imageName);

            Image::where('user_id', $pet->id)->delete();

            $image = Image::create([
                'user_id' => $pet->id,
                'filename' => basename($imageName),
                'url' => $imageName,
            ]);
        }
    }

    public static function updatePetImage($request, $pet)
    {
        if ($request->has('image')) {
            $img_validation = $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10048',
            ]);

            if ($pet->image) {
                $image_path = public_path() . '/images/' . $pet->image->filename;
                unlink($image_path);

                $image = Image::find($pet->image->id)->delete();
            }

            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('images'), $imageName);

            Image::where('user_id', $pet->id)->delete();

            $image = Image::create([
                'user_id' => $pet->id,
                'filename' => basename($imageName),
                'url' => $imageName,
            ]);
        }
    }

    public static function getUrlToken($request)
    {
        $url = $request->fullUrl();

        $token = substr($url, -30);

        return $token;
    }

    public static function founded($request)
    {
        try {

            $lat = '';
            $long = '';

            if ($request->has('long') && $request->has('lat')) {
                $lat = $request->lat;
                $long = $request->long;

                $data = [
                    'tag_id' => $request->token,
                    'latitude' => $request->lat,
                    'longitude' => $request->long,
                ];

                TagHistory::create($data);
            }

            $mailData = [
                'title' => 'Ljubimac Pronadjen!',
                'body' => 'Neko je aktivirao pametni tag!',
                'long' => $long,
                'lat' => $lat,
            ];

            if ($request->has('email')) {
                // Mail::to($request->email)->send(new TagMail($mailData));
            }

            $response = [];
            $response['status'] = 'ok';
            $response['code'] = 200;

            return $response;

        } catch (\Throwable $th) {

            $response = [];
            $response['status'] = 'error';
            $response['code'] = 405;

            return $response;

        }
    }

    public static function send_number($request)
    {
        try {

            $founder_phone = '';

            if ($request->has('founder_phone')) {
                $founder_phone = $request->founder_phone;
            }

            $mailData = [
                'title' => 'Pronalazac!',
                'body' => 'Pronalazac vam salje svoj broj telefona!',
                'founder_phone' => $founder_phone,
            ];

            if ($request->has('email')) {
                // Mail::to($request->email)->send(new FounderMail($mailData));
            }

            $response = [];
            $response['status'] = 'ok';
            $response['code'] = 200;

            return $response;

        } catch (\Throwable $th) {

            $response = [];
            $response['status'] = 'error';
            $response['code'] = 405;

            return $response;

        }
    }

    public static function setMissingStatus($pet)
    {
        $emailList = User::where('missing_notification', '1')->pluck('email');
        $missingStatus = $pet->missing;

        foreach ($emailList as $email) {
            $mailData = [
                'email' => $email,
            ];

            if ($missingStatus == Pet::Missing) {
                $mailData['title'] = 'Ljubimac Izgubljen!';
                $mailData['body'] = 'Ako vidite ovog ljubimca, očitajte tag i obavestite staratelja!';
                $mailData['missing'] = 'missing';
            } else {
                $mailData['title'] = 'Ljubimac Pronađen!';
                $mailData['body'] = 'Potraga za izgubljenom šapom je okončana!';
                $mailData['missing'] = 'founded';
            }

            // dispatch(new SendEmailJob((object) $mailData, $pet));
            // Mail::to($email)->queue(new MissingMail((object) $mailData, $pet));
        }

        $pet->missing = ($missingStatus == Pet::Missing) ? 1 : 0;
        $pet->save();
    }

}
