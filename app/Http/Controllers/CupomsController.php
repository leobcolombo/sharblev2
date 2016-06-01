<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\AdminCupomRequest;
use Illuminate\Http\Request;
use App\Repositories\CupomRepository;

class CupomsController extends Controller
{

	public function __construct(CupomRepository $repository) {
		$this->repository = $repository;
	}

    public function index() {

    	$cupoms = $this->repository->paginate(5);

    	return view('admin.cupoms.index', compact('cupoms'));
    }

    public function create() {
    	return view('admin.cupoms.create');
    }

    public function store(AdminCupomRequest $request) {

    	$data = $request->all();
    	$this->repository->create($data);

    	return redirect()->route('admin.cupoms.index');
    }

    public function edit($id) {
    	$category = $this->repository->find($id);

    	return view('admin.cupoms.edit',compact('cupom'));
    }

    public function update(AdminCupomRequest $request, $id) {

    	$data = $request->all();
    	$this->repository->update($data, $id);

    	return redirect()->route('admin.cupoms.index');

    }

    public function destroy($id) {
        $this->repository->delete($id);
        return redirect()->route('admin.cupoms.index');
    }

}
