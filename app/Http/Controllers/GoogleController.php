public function redirect()
{
    return Socialite::driver('google')->redirect();
}

public function callback()
{
    // Handle Google response
}
