<?php

namespace scool\enrollment_payments\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\DiscountsCreateRequest;
use App\Http\Requests\DiscountsUpdateRequest;
use scool\enrollment_payments\Repositories\DiscountsRepository;
use scool\enrollment_payments\Validators\DiscountsValidator;


class DiscountsController extends Controller
{

    /**
     * @var DiscountsRepository
     */
    protected $repository;

    /**
     * @var DiscountsValidator
     */
    protected $validator;

    public function __construct(DiscountsRepository $repository, DiscountsValidator $validator)
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
        $discounts = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $discounts,
            ]);
        }

        return view('discounts.index', compact('discounts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  DiscountsCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(DiscountsCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $discount = $this->repository->create($request->all());

            $response = [
                'message' => 'Discounts created.',
                'data'    => $discount->toArray(),
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
        $discount = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $discount,
            ]);
        }

        return view('discounts.show', compact('discount'));
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

        $discount = $this->repository->find($id);

        return view('discounts.edit', compact('discount'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  DiscountsUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(DiscountsUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $discount = $this->repository->update($id, $request->all());

            $response = [
                'message' => 'Discounts updated.',
                'data'    => $discount->toArray(),
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
                'message' => 'Discounts deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Discounts deleted.');
    }
}
