<div style="text-align: center">

    <button wire:click="login">Login</button>

    <h1>{{ $count }}</h1>

    <a
        href="https://twitter.com/i/oauth2/authorize?response_type=code&client_id=ejQ4YWZDX0o4cEl6bDBHMlFNczg6MTpjaQ&redirect_uri=http://127.0.0.1:8000/callback&scope=tweet.write%20tweet.read%20users.read%20follows.read%20offline.access&state=state&code_challenge=challenge&code_challenge_method=plain">Twitter</a>
</div>
