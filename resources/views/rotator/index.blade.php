@extends('app')

@section('content')
    <h1 class="page-heading">Faucet Rotator</h1>

    <nav id="nav_buttons">
        <ul class="horizontal_list">
            <li><a class="btn btn-primary btn-lg faucet-nav" id="first_faucet" title="First Faucet" role="button">First</a></li>
            <li><a class="btn btn-primary btn-lg faucet-nav" id="previous_faucet" title="Previous Faucet" role="button">Previous</a></li>
            <li><a class="btn btn-primary btn-lg faucet-nav" id="current" href="" target="_blank" title="Current Faucet (opens in new window)" role="button">Current</a></li>
            <li><a class="btn btn-primary btn-lg faucet-nav" id="reload_current" title="Reload Current Faucet" role="button">Reload Current</a></li>
            <li><a class="btn btn-primary btn-lg faucet-nav" id="next_faucet" title="Next Faucet" role="button">Next</a></li>
            <li><a class="btn btn-primary btn-lg faucet-nav" id="last_faucet" title="Last Faucet" role="button">Last</a></li>
            <li><a class="btn btn-primary btn-lg faucet-nav" id="list_of_faucets" href="#" title="List of Faucets" role="button">List of Faucets</a></li>
        </ul>
    </nav>

    <iframe sandbox="allow-forms allow-scripts allow-pointer-lock allow-same-origin" src="" id="rotator-iframe"></iframe>
    <script src="js/rotator.js"></script>
@endsection