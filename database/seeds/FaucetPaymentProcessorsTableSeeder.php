<?php
use App\Faucet;
use App\PaymentProcessor;

/**
 * Created by PhpStorm.
 * User: robattfield
 * Date: 03-Mar-2015
 * Time: 18:56
 */

class FaucetPaymentProcessorsTableSeeder extends BaseSeeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paymentProcessors = PaymentProcessor::all();
        foreach($paymentProcessors as $paymentProcessor){
            switch($paymentProcessor->name){
                case 'CoinBase':
                    $dataFaucet = Faucet::where('name', 'DataFaucet')->first();
                    $dataFaucet->paymentProcessors()->attach(
                        $paymentProcessor->where('name', '=', 'CoinBase')->first()->id
                    );
                    break;
                case 'Direct':
                    $faucets = [
                        //16//
                        Faucet::where('name', 'Mellow Ads')->first(),
                        Faucet::where('name', 'Bit Fun')->first(),
                        Faucet::where('name', 'TrustBtcFaucet')->first(),
                        Faucet::where('name', 'BitEnergy')->first(),
                        Faucet::where('name', 'CarBitcoin')->first(),
                        Faucet::where('name', 'Bonus Bitcoin')->first(),
                        Faucet::where('name', 'Claim BTC')->first(),
                        Faucet::where('name', 'BioBTC')->first(),
                        Faucet::where('name', 'Moon Faucet')->first(),
                        Faucet::where('name', 'BTC 4 You')->first(),
                        Faucet::where('name', '777Bitco.in')->first(),
                        Faucet::where('name', 'Bitcoin Showers')->first(),
                        Faucet::where('name', 'TreeBitcoin')->first(),
                        Faucet::where('name', 'Bitcoin Faucet TK')->first(),
                        Faucet::where('name', 'Field Bitcoins')->first(),
                        Faucet::where('name', 'Moon Bitcoin')->first(),
                    ];
                    for($i = 0; $i < count($faucets); $i++){
                        $faucets[$i]->paymentProcessors()->attach(
                            $paymentProcessor->where('name', '=', 'Direct')->first()->id
                        );
                    }
                    break;
                case 'Epay':
                    $faucets = [
                        //17//
                        Faucet::where('name', 'FCoin')->first(),
                        Faucet::where('name', 'Get Your Bitcoin')->first(),
                        Faucet::where('name', 'Chronox')->first(),
                        Faucet::where('name', 'Time for Bitco')->first(),
                        Faucet::where('name', 'BustedFaucet')->first(),
                        Faucet::where('name', 'BTC Pour')->first(),
                        Faucet::where('name', 'Sun BTC Space')->first(),
                        Faucet::where('name', 'One Way Faucet')->first(),
                        Faucet::where('name', 'Bitcoin Expose')->first(),
                        Faucet::where('name', 'GoldsDay')->first(),
                        Faucet::where('name', 'Chess Faucet')->first(),
                        Faucet::where('name', 'Switch Bux')->first(),
                        Faucet::where('name', 'PayMyClic')->first(),
                        Faucet::where('name', 'Coin Prizes')->first(),
                        Faucet::where('name', 'Omnibot\'s Faucet')->first(),
                        Faucet::where('name', 'IFaucet')->first(),
                        Faucet::where('name', 'Field Bitcoins')->first(),
                    ];
                    for($i = 0; $i < count($faucets); $i++){
                        $faucets[$i]->paymentProcessors()->attach(
                            $paymentProcessor->where('name', '=', 'Epay')->first()->id
                        );
                    }

                    break;
                case 'FaucetHub.io':
                    $faucets = [
                        //18//
                        Faucet::where('name', 'IFaucet')->first(),
                        Faucet::where('name', 'X-Faucet')->first(),
                        Faucet::where('name', 'Konstantinova')->first(),
                        Faucet::where('name', 'Fautsy')->first(),
                        Faucet::where('name', 'Bitcoin Faucetdog')->first(),
                        Faucet::where('name', 'FastBit')->first(),
                        Faucet::where('name', 'BitPearl')->first(),
                        Faucet::where('name', 'Hot Coins')->first(),
                        Faucet::where('name', 'BitUniverse')->first(),
                        Faucet::where('name', 'Marxian Roll Faucet')->first(),
                        Faucet::where('name', 'One Click Faucet')->first(),
                        Faucet::where('name', 'The BTC Faucet')->first(),
                        Faucet::where('name', 'BTC Leets')->first(),
                        Faucet::where('name', 'BTCLeak Bitcoin Faucet')->first(),
                        Faucet::where('name', 'FreeBits')->first(),
                        Faucet::where('name', 'FaucetMega')->first(),
                        Faucet::where('name', 'Penta Faucet')->first(),
                        Faucet::where('name', 'Free4Faucet')->first(),
                    ];
                    for($i = 0; $i < count($faucets); $i++){
                        $faucets[$i]->paymentProcessors()->attach(
                            $paymentProcessor->where('name', '=', 'FaucetHub.io')->first()->id
                        );
                    }
                    break;
                case 'FaucetSystem':
                        Faucet::where('name', 'IFaucet')->first()->paymentProcessors()->attach(
                            $paymentProcessor->where('name', '=', 'FaucetSystem')->first()->id
                        );
                    break;
                case 'PurseFaucets':
                    $faucets = [
                        Faucet::where('name', 'IFaucet')->first(),
                        Faucet::where('name', 'BitcoBear')->first(),
                        Faucet::where('name', 'BitcoBear2')->first(),
                        Faucet::where('name', 'BitcoBear3')->first(),
                        Faucet::where('name', 'BitcoBear4')->first(),
                        Faucet::where('name', 'BitcoBear5')->first(),
                    ];
                    for($i = 0; $i < count($faucets); $i++){
                        $faucets[$i]->paymentProcessors()->attach(
                            $paymentProcessor->where('name', '=', 'PurseFaucets')->first()->id
                        );
                    }
                    break;
                case 'Xapo':
                    $faucets = [
                        Faucet::where('name', 'Moon Bitcoin')->first(),
                        Faucet::where('name', 'Free4Faucet')->first(),
                        Faucet::where('name', 'Kiixa')->first(),
                        Faucet::where('name', 'Play Bitcoin')->first(),
                        Faucet::where('name', 'BitcoinBow')->first(),
                        Faucet::where('name', 'Bitcoinker')->first(),
                        Faucet::where('name', 'WaterBitcoin')->first(),
                        Faucet::where('name', 'We Love Bitcoin')->first(),
                        Faucet::where('name', 'BTC Source')->first(),
                    ];
                    for($i = 0; $i < count($faucets); $i++){
                        $faucets[$i]->paymentProcessors()->attach(
                            $paymentProcessor->where('name', '=', 'Xapo')->first()->id
                        );
                    }
                    break;
            }
        }
    }
}
