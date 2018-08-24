<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\ProductBids;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductsController extends Controller
{
    private $logger;
    const ERROR_RETURN_VALUE = 'Error';

    public function __construct(Log $logger)
    {
        $this->logger = $logger;
    }

    public function showProducts () {

        try {

            $products = Products::all([
                'id',
                'name',
                'price'
            ]);

            if (!empty($products)) {

                return view('products', ['products' => $products]);

            } else {

                $this->logger::info('NULL products returned', $products);

                return view('generic_error');
            }

        } catch (\Exception $exception) {

            $this->logger::error($exception->getTraceAsString());

            return view('generic_error');
        }
    }

    public function viewProduct (Request $request, $productId) {

        $request->merge(['productId' => $productId]);

        try {

            $this->validate(
                $request,
                [
                    'productId' => 'required|regex: /^[0-9]+$/',
                ]
            );

            $productId = $request['productId'];

        } catch (ValidationException $e) {

            $this->logger::error($e->getTraceAsString());

            return view('generic_error');
        }

        try {

            $productData = Products::where([
                'id' => $productId
            ])->get()->toArray();

            if (!empty($productData)) {

                Products::where([
                    'id' => $productId
                ])->update([
                    'viewCount' => $productData[0]['viewCount'] + 1
                ]);

                return view('product', ['product' => $productData]);
            }

            return view('generic_error');

        } catch (\Exception $exception) {

            $this->logger::error($exception->getTraceAsString());

            return view('generic_error');
        }
    }

    public function bidProduct (Request $request, $productId) {

        $request->merge(['productId' => $productId]);

        try {

            $this->validate(
                $request,
                [
                    'productId' => 'required|regex: /^[0-9]+$/',
                ]
            );

            $productId = $request['productId'];

        } catch (ValidationException $e) {

            $this->logger::error($e->getTraceAsString());

            return view('generic_error');
        }

        try {

            $productData = Products::where([
                'id' => $productId
            ])->get()->toArray();

            if (!empty($productData)) {

                return view('bid', ['product' => $productData]);
            }

            return view('generic_error');

        } catch (\Exception $exception) {

            $this->logger::error($exception->getTraceAsString());

            return view('generic_error');
        }
    }

    public function placeBid (Request $request) {

        try {

            $this->validate(
                $request,
                [
                    'product_id' => 'required|regex: /^[0-9]+$/',
                    'user_email' => 'required',
                    'bid_price' => 'required',
                ]
            );

        } catch (ValidationException $e) {

            $this->logger::error($e->getTraceAsString());

            return view('generic_error');
        }

        $this->logger::info($request);
        $productId = $request['product_id'];
        $userEmail = $request['user_email'];
        $bidPrice = $request['bid_price'];

        try {

            $duplicateBidCheck = self::isDuplicateBid($productId, $userEmail);
            $this->logger::info('Duplicate check results');
            $this->logger::info($duplicateBidCheck);

            if (true === $duplicateBidCheck) {

                $this->logger::info('Duplicate bid for productId: ' . $productId . ' with user email: ' . $userEmail);
                return view('duplicate_bid');
            }

            if (self::ERROR_RETURN_VALUE === $duplicateBidCheck) {

                return view('generic_error');
            }

            $productBids = new ProductBids();
            $productBids['productId'] = $productId;
            $productBids['userEmail'] = $userEmail;
            $productBids['bidPrice'] = $bidPrice;
            $productBids->save();

            $this->logger::info('Products Bid obj');
            $this->logger::info($productBids);

            $bidCount = self::getBidCount($productId) + 1;
            $this->logger::info('Bid count');
            $this->logger::info($bidCount);
            $highestBid = self::getHighestBid($productId);
            $this->logger::info('Highest Bid');
            $this->logger::info($highestBid);
            $lowestBid = self::getLowestBid($productId);
            $this->logger::info('Lowest Bid');
            $this->logger::info($lowestBid);

            if ($bidPrice > $highestBid) {

                self::setHighestBid($productId, $bidPrice);
            }

            if ($bidPrice < $lowestBid || 0 === $lowestBid) {

                self::setLowestBid($productId, $bidPrice);
            }

            self::setBidCount($productId, $bidCount);

            return view('successful_bid');

        } catch (\Exception $exception) {

            $this->logger::error($exception->getTraceAsString());

            return view('generic_error');
        }
    }


    private function getHighestBid ($productId) {

        try {

            $highestBid = Products::where([
                'id' => $productId
            ])->get([
                'highestBid'
            ]);

            if (!empty($highestBid)) {

                return $highestBid['highestBid'];
            }

            return false;

        } catch (\Exception $exception) {

            $this->logger::error($exception->getTraceAsString());

            return self::ERROR_RETURN_VALUE;
        }
    }

    private function getLowestBid ($productId) {

        try {

            $lowestBid = Products::where([
                'id' => $productId
            ])->get([
                'lowestBid'
            ]);

            if (!empty($lowestBid)) {

                return $lowestBid['lowestBid'];
            }

            return false;

        } catch (\Exception $exception) {

            $this->logger::error($exception->getTraceAsString());

            return self::ERROR_RETURN_VALUE;
        }
    }

    private function getBidCount ($productId) {

        try {

            $bidCount = Products::where([
                'id' => $productId
            ])->get([
                'bidCount'
            ]);

            if (!empty($bidCount)) {

                return $bidCount['bidCount'];
            }

            return false;

        } catch (\Exception $exception) {

            $this->logger::error($exception->getTraceAsString());

            return self::ERROR_RETURN_VALUE;
        }
    }

    private function isDuplicateBid ($productId, $userEmail) {

        try {

            $existCount = ProductBids::where([
                'productId' => $productId,
                'userEmail' => $userEmail
            ])->exists();

            $this->logger::info($existCount);

            if ($existCount === 1) {

                $this->logger::info('Existing bid');

                return true;
            }

            $this->logger::info('New bid');

            return false;

        } catch (\Exception $exception) {

            $this->logger::info('Error placing bid');
            $this->logger::error($exception->getTraceAsString());

            return self::ERROR_RETURN_VALUE;
        }
    }

    private function setHighestBid ($productId, $highestBid) {

        try {

            Products::where([
                'id' => $productId
            ])->update([
                'highestBid' => $highestBid
            ]);

        } catch (\Exception $exception) {

            $this->logger::error($exception->getTraceAsString());

            return view('generic_error');
        }
    }

    private function setLowestBid ($productId, $lowestBid) {

        try {

            Products::where([
                'id' => $productId
            ])->update([
                'lowestBid' => $lowestBid
            ]);

        } catch (\Exception $exception) {

            $this->logger::error($exception->getTraceAsString());

            return view('generic_error');
        }
    }

    private function setBidCount ($productId, $bidCount) {

        try {

            Products::where([
                'id' => $productId
            ])->update([
                'bidCount' => $bidCount
            ]);

        } catch (\Exception $exception) {

            $this->logger::error($exception->getTraceAsString());

            return view('generic_error');
        }
    }
}
