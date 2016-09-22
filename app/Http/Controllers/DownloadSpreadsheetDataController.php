<?php

namespace App\Http\Controllers;

use App\AdBlock;
use App\MainMeta;
use App\PaymentProcessor;
use Illuminate\Database\Eloquent\Collection;
use App\Faucet;
use League\Csv\Writer;
use Schema;
use SplTempFileObject;

/**
 * Class DownloadSpreadsheetDataController
 *
 * A controller class used for downloading faucet rotator data.
 *
 * @author Rob Attfield <emailme@robertattfield.com> <http://www.robertattfield.com>
 *
 * @package App\Http\Controllers
 */
class DownloadSpreadsheetDataController extends Controller
{
    /**
     * DownloadSpreadsheetData constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the main page for downloading faucet rotator data.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view('download_data.index');
    }

    /**
     * Create and download faucets data as CSV file.
     */
    public function getFaucetsData(){

        $faucets = Faucet::all();

        $this->createCsv($faucets, 'faucets');
    }

    /**
     * Create and download payment processors data as CSV file.
     */
    public function getPaymentProcessorsData(){

        $paymentProcessors = PaymentProcessor::all();

        $this->createCsv($paymentProcessors, 'payment_processors');
    }

    /**
     * Create and download faucets/payment processors linking data as CSV file.
     */
    public function getFaucetsPaymentProcessorsLinkingData(){

        $faucets = Faucet::all();

        $csv = Writer::createFromFileObject(new SplTempFileObject());

        $csv->insertOne(Schema::getColumnListing('faucet_payment_processor'));

        foreach ($faucets as $f){

            $paymentProcessors = $f->paymentProcessors()->get();

            foreach ($paymentProcessors as $p){
                $data = ['faucet_id' => $f->id, 'payment_processor_id' => $p->id];
                $csv->insertOne($data);
            }
        }

        $csv->output('faucets_payment_processors.csv');
    }

    /**
     * Create and download ad block data as CSV file.
     */
    public function getAdBlockData(){

        $adBlock = AdBlock::all();

        $this->createCsv($adBlock, 'ad_block');
    }

    /**
     * Create and download main meta data as CSV file.
     */
    public function getMainMetaData(){

        $mainMeta = MainMeta::all();

        $this->createCsv($mainMeta, 'main_meta');
    }

    /**
     * A function to generate a CSV for a given model collection.
     *
     * @param Collection $modelCollection
     * @param $tableName
     */
    private function createCsv(Collection $modelCollection, $tableName){

        $csv = Writer::createFromFileObject(new SplTempFileObject());

        $csv->insertOne(Schema::getColumnListing($tableName));

        foreach ($modelCollection as $data){
            $csv->insertOne($data->toArray());
        }

        $csv->output($tableName . '.csv');

    }
}
