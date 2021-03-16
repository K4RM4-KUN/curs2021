<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGolosinaRequest;
use App\Http\Requests\UpdateGolosinaRequest;
use App\Repositories\GolosinaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class GolosinaController extends AppBaseController
{
    /** @var  GolosinaRepository */
    private $golosinaRepository;

    public function __construct(GolosinaRepository $golosinaRepo)
    {
        $this->golosinaRepository = $golosinaRepo;
    }

    /**
     * Display a listing of the Golosina.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $golosinas = $this->golosinaRepository->all();

        return view('golosinas.index')
            ->with('golosinas', $golosinas);
    }

    /**
     * Show the form for creating a new Golosina.
     *
     * @return Response
     */
    public function create()
    {
        return view('golosinas.create');
    }

    /**
     * Store a newly created Golosina in storage.
     *
     * @param CreateGolosinaRequest $request
     *
     * @return Response
     */
    public function store(CreateGolosinaRequest $request)
    {
        $input = $request->all();

        $golosina = $this->golosinaRepository->create($input);

        Flash::success('Golosina saved successfully.');

        return redirect(route('golosinas.index'));
    }

    /**
     * Display the specified Golosina.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $golosina = $this->golosinaRepository->find($id);

        if (empty($golosina)) {
            Flash::error('Golosina not found');

            return redirect(route('golosinas.index'));
        }

        return view('golosinas.show')->with('golosina', $golosina);
    }

    /**
     * Show the form for editing the specified Golosina.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $golosina = $this->golosinaRepository->find($id);

        if (empty($golosina)) {
            Flash::error('Golosina not found');

            return redirect(route('golosinas.index'));
        }

        return view('golosinas.edit')->with('golosina', $golosina);
    }

    /**
     * Update the specified Golosina in storage.
     *
     * @param int $id
     * @param UpdateGolosinaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGolosinaRequest $request)
    {
        $golosina = $this->golosinaRepository->find($id);

        if (empty($golosina)) {
            Flash::error('Golosina not found');

            return redirect(route('golosinas.index'));
        }

        $golosina = $this->golosinaRepository->update($request->all(), $id);

        Flash::success('Golosina updated successfully.');

        return redirect(route('golosinas.index'));
    }

    /**
     * Remove the specified Golosina from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $golosina = $this->golosinaRepository->find($id);

        if (empty($golosina)) {
            Flash::error('Golosina not found');

            return redirect(route('golosinas.index'));
        }

        $this->golosinaRepository->delete($id);

        Flash::success('Golosina deleted successfully.');

        return redirect(route('golosinas.index'));
    }
}
