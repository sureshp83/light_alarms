<?php
//TODO - The attachment of images are not yet implemented for emails.

namespace App\Http\Controllers;

use Auth;
use Exception;
use App\Models\RequestCustomBrochure;
use App\Models\RequestDisplayBoard;
use App\Models\RequestSalesLiterature;
use App\Http\Requests\DisplayBoardRequest;
use App\Http\Requests\CustomBrochureRequest;
use App\Http\Requests\SalesLiteratureRequest;
use App\Mail\DisplayBoardMail;
use App\Mail\SalesLiteratureMail;
use Caffeinated\Flash\Facades\Flash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MarketingToolsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Get Routes
    |--------------------------------------------------------------------------
    */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view("marketingTools.index");
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getSalesLiterature()
    {
        return view("marketingTools.sales_literature_request");

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCustomBrochure()
    {
        return view("marketingTools.custom_brochure_request");

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getDisplayBoard()
    {
        return view("marketingTools.display_board_request");
    }


    /*
    |--------------------------------------------------------------------------
    | Post Routes
    |--------------------------------------------------------------------------
    */

    /**
     * @param SalesLiteratureRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postSalesLiterature(SalesLiteratureRequest $request)
    {
        try {
            $inputs = $request->except("_method", "_token");

            $salesLiterature = new RequestSalesLiterature();
            $salesLiterature->literatures  = array_flatten($request->input('literatures'));
            $salesLiterature->submit_by_id = Auth::user()->id;
            $salesLiterature->fill($inputs)->save();

            Mail::to($request->user())
                ->queue((new SalesLiteratureMail($salesLiterature))
                ->onQueue('emails'));

            Flash::success('Request sent successfully.');

        } catch (Exception $e){
            Flash::error("ERROR: {$e->getCode()}");
        }

        return redirect()->back();
    }

    /**
     * Store Custom Brochure Request.
     *
     * @param  CustomBrochureRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCustomBrochure(CustomBrochureRequest $request)
    {
        /* TODO
         * Save the request information
         * save the image
         * */

            $_req = new RequestCustomBrochure();
            $_req->submit_by_id = Auth::user()->id;
            $_req->fill($request->except("_method", "_token"))->save();

            Flash::success('Request sent successfully.');

        try {
        } catch (Exception $e){
            Flash::error($e->getCode());
        }

        return redirect()->back();
    }

    /**
     * Store Display Board Request.
     *
     * @param  DisplayBoardRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDisplayBoard(DisplayBoardRequest $request)
    {
        try {
            $logo = '';

            // Save distributor logo
            if ($request->hasFile('distributor_logo')) {
                $logo = $request->file('distributor_logo')->store('/public/distributor_logo');
            }

            $_req = new RequestDisplayBoard();
            $_req->product_ids  = array_flatten($request->input('product_ids'));
            $_req->submit_by_id = Auth::user()->id;
            $_req->fill($request->except("_method", "_token"))->save();

            Mail::to(config("mail.display_board_to"))
                ->queue(new DisplayBoardMail($_req, $logo));

            Flash::success('Request sent successfully.');

        } catch (Exception $e){
            Flash::error("ERROR: {$e->getCode()}");
        }

        return redirect()->back();
    }
}
