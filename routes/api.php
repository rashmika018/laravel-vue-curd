<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\LeadController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('data', [APIController::class, 'index']);
Route::post('post', [APIController::class, 'index']);

Route::resource('leads', LeadController::class)->only(['index','store','show','update','destroy']);


Route::get('/redirect', function (Request $request) {
    dd($request);
    $request->session()->put('state', $state = Str::random(40));
    
    $request->session()->put(
        'code_verifier', $code_verifier = Str::random(128)
        );
   
    
    $codeChallenge = strtr(rtrim(
        base64_encode(hash('sha256', $code_verifier, true))
        , '='), '+/', '-_');
    
    
    $query = http_build_query([
        'client_id' => 'client-id',
        'redirect_uri' => 'http://third-party-app.com/callback',
        'response_type' => 'code',
        'scope' => '',
        'state' => $state,
        'code_challenge' => $codeChallenge,
        'code_challenge_method' => 'S256',
    ]);
    
    return redirect('http://passport-app.com/oauth/authorize?'.$query);
});


Route::get('/callback', function (Request $request) {
    dd($request);
    $state = $request->session()->pull('state');
    $codeVerifier = $request->session()->pull('code_verifier');
    
    throw_unless(
        strlen($state) > 0 && $state === $request->state,
        InvalidArgumentException::class
        );
    
    $response = Http::asForm()->post('http://passport-app.com/oauth/token', [
        'grant_type' => 'authorization_code',
        'client_id' => 'client-id',
        'redirect_uri' => 'http://third-party-app.com/callback',
        'code_verifier' => $codeVerifier,
        'code' => $request->code,
    ]);
    
    return $response->json();
});



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

