@extends('app')

@section('title', $main_meta->title)

@section('description', $main_meta->description)

@section('keywords', $main_meta->keywords)

@section('content')
<h1 id="page-heading">Welcome to the Bitcoin Faucet Rotator</h1>
@include('partials.ads')
<nav id="navcontainer">
    <ul id="navlist">
        <li><a class="btn btn-primary btn-lg" id="first_faucet" title="First Faucet" role="button">First</a></li>
        <li><a class="btn btn-primary btn-lg" id="previous_faucet" title="Previous Faucet" role="button">Previous</a></li>
        <li><a class="btn btn-primary btn-lg" id="current" href="" target="_blank" title="Current Faucet (opens in new window)" role="button">Current</a></li>
        <li><a class="btn btn-primary btn-lg" id="reload_current" title="Reload Current Faucet" role="button">Reload Current</a></li>
        <li><a class="btn btn-primary btn-lg" id="next_faucet" title="Next Faucet" role="button">Next</a></li>
        <li><a class="btn btn-primary btn-lg" id="last_faucet" title="Last Faucet" role="button">Last</a></li>
        <li><a class="btn btn-primary btn-lg" id="random" title="Random Faucet" role="button">Random</a></li>
        <li><a class="btn btn-primary btn-lg" id="list_of_faucets" href="/faucets" title="List of Faucets" role="button">List of Faucets</a></li>
    </ul>
</nav>

<iframe sandbox="allow-forms allow-scripts allow-pointer-lock allow-same-origin" src="" id="rotator-iframe"></iframe>
<script src="js/rotator.js?{{ rand()}}"></script>

<div class="row">
    <div class="col-lg-12">
        <h2 id="whatisbitcoin">Huh? What is this 'Bitcoin' thing?</h2>

        <p>There are a wealth of resources out there on Bitcoins - how they are made, why they were made, and how they are used. Bitcoins are a form of digital currency that isn't centralised (like banks), and are created by (sometimes) powerful machines (commonly called 'mining rigs') that perform numerous mathematical and algorithmic calculations. Below are some resources that will explain Bitcoins:</p>

        <ul id="bitcoin-info-links">
            <li><a href="http://bitcoin.org/en/" title="The Official Bitcoin Website" target="_blank">The Official Bitcoin Website</a></li>
            <li><a href="http://www.weusecoins.com/" title="What is Bitcoin? - We Use Coins" target="_blank">What is Bitcoin? - We Use Coins</a></li>
            <li><a href="https://en.bitcoin.it/wiki/Main_Page" title="The Bitcoin Wiki" target="_blank">The Bitcoin Wiki</a></li>
            <li><a href="https://bitcoinfoundation.org/" title="The Bitcoin Foundation" target="_blank">The Bitcoin Foundation</a></li>
            <li><a href="http://bitcoin.stackexchange.com/" title="Bitcoin Stack Exchange Q and A Site" target="_blank">Bitcoin Stack Exchange Q and A Site</a></li>
            <li><a href="https://bitcointalk.org/" title="Bitcoin Talk Forum" target="_blank">Bitcoin Talk Forum</a></li>
        </ul>
    </div>
</div>

<div class="row" id="bitcoin-wallets">
    <div class="col-lg-12">
        <h2>Needing a Bitcoin Wallet?</h2>

        <p>In order to receive bitcoins, you usually need a bitcoin address for the sender to send them to. You are able to select one of the providers below to create your bitcoin wallet/address:</p>

        <h3>Web-based Wallet Providers</h3>
        <ul class="bitcoin-wallet-links">
            <li><a href="https://coinbase.com/?r=52b3ca3962893c879300002e&utm_campaign=user-referral&src=referral-link" title="CoinBase.com" target="_blank">CoinBase.com</a></li>
            <li><a href="https://www.microwallet.org/" title="MicroWallet" target="_blank">MicroWallet</a></li>
            <li><a href="https://blockchain.info/wallet" title="BlockChain" target="_blank">BlockChain</a></li>
            <li><a href="https://coinkite.com/">CoinKite</a></li>
        </ul>

        <h3>Bitcoin Wallet Clients - Install On Your Computer</h3>
        <ul class="bitcoin-wallet-links">
            <li><a href="http://bitcoin.org/en/download" title="Bitcoin Qt" target="_blank">Bitcoin Qt (the original client)</a></li>
            <li><a href="https://bitcoinarmory.com/" title="Bitcoin Armory" target="_blank">Bitcoin Armory</a></li>
            <li><a href="https://multibit.org/" title="MultiBit" target="_blank">MultiBit</a></li>
        </ul>
    </div>
</div>

<div class="row" id="vote-for-us">
    <div class="col-lg-12">
	    <h2>Vote For Us!</h2>
		
	    <p>We are listed in the following crypto directories - please vote for us if you find our site useful!</p>
		
		<p><a href="http://top-faucets.com/"><img src="http://top-faucets.com/button.php?u=freebtc-website" alt="Top Faucets - Best of all cryptocurreny faucets!" border="0" /></a></p>
		<p><a target="_blank" href="http://www.freecrypto.co/vote.php?id=155"><img src="http://www.freecrypto.co/images/468x60.png" alt="Vote for FreeBTC.Website on FreeCrypto!" /></a></p>
		
	</div>
</div>


@endsection

@section('google_analytics')
    @include('partials.google_analytics')
@stop
