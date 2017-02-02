<?php
/**
 * Created by PhpStorm.
 * User: oscar
 * Date: 2/02/17
 * Time: 21:39
 */

namespace scool\enrollment_payments\Http\Controllers;


use scool\enrollment_payments\Repositories\PaymentRepository;
use scool\enrollment_payments\Validators\PaymentValidator;

class PaymentController extends Controller
{
    /**
     * @var PaymentController
     */
    protected $repository;

    /**
     * @var PaymentValidator
     */
    protected $validator;

    public function __construct(PaymentRepository $repository, PaymentValidator $validator)
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
        $payment = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $payment,
            ]);
        }

        return view('payment.index', compact('payment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PaymentCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $payment = $this->repository->create($request->all());

            $response = [
                'message' => 'Payment created.',
                'data'    => $payment->toArray(),
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
        $payment = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $payment,
            ]);
        }

        return view('payment.show', compact('payment'));
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

        $payment = $this->repository->find($id);

        return view('payment.edit', compact('payment'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  PaymentUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(PaymentUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $payment = $this->repository->update($id, $request->all());

            $response = [
                'message' => 'Payment updated.',
                'data'    => $payment->toArray(),
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
                'message' => 'Payment deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Payment deleted.');
    }
}