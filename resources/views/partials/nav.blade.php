<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Bitcoin Faucet Rotator</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="/">Home</a></li>
                @if (Auth::user())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Faucets <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/faucets">View Faucets</a></li>
                            <li><a href="/faucets/create">Add New Faucet</a></li>
                        </ul>
                    </li>
                @else
                    <li><a href="/faucets">Faucets</a></li>
                @endif
                @if (Auth::user())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Payment Processors<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/payment_processors">View Payment Processors</a></li>
                            <li><a href="/payment_processors/create">Add New Payment Processor</a></li>
                        </ul>
                    </li>
                @else
                    <li><a href="/payment_processors">Payment Processors</a></li>
                @endif
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="/auth/login">Login</a></li>
                    <li><a href="/auth/register">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->first_name . ' ' .  Auth::user()->last_name}} <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/auth/logout">Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>