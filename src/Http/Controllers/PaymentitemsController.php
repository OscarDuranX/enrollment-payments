<?php

namespace scool\enrollment_payments\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\PaymentitemCreateRequest;
use App\Http\Requests\PaymentitemUpdateRequest;
use scool\enrollment_payments\Repositories\PaymentitemRepository;
use scool\enrollment_payments\Validators\PaymentitemValidator;


class PaymentitemsController extends Controller
{

    /**
     * @var PaymentitemRepository
     */
    protected $repository;

    /**
     * @var PaymentitemValidator
     */
    protected $validator;

    public function __construct(PaymentitemRepository $repository, PaymentitemValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $paymentitems = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $paymentitems,
            ]);
        }

        return view('paymentitems.index', compact('paymentitems'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PaymentitemCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentitemCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $paymentitem = $this->repository->create($request->all());

            $response = [
                'message' => 'Paymentitem created.',
                'data'    => $paymentitem->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $paymentitem = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $paymentitem,
            ]);
        }

        return view('paymentitems.show', compact('paymentitem'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $paymentitem = $this->repository->find($id);

        return view('paymentitems.edit', compact('paymentitem'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  PaymentitemUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(PaymentitemUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $paymentitem = $this->repository->update($id, $request->all());

            $response = [
                'message' => 'Paymentitem updated.',
                'data'    => $paymentitem->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Paymentitem deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Paymentitem deleted.');
    }
}
