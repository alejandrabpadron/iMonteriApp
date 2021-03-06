<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoriasRequest;
use App\Http\Requests\UpdateCategoriasRequest;
use App\Repositories\CategoriasRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class CategoriasController extends AppBaseController
{
    /** @var  CategoriasRepository */
    private $categoriasRepository;

    public function __construct(CategoriasRepository $categoriasRepo)
    {
        $this->categoriasRepository = $categoriasRepo;
    }

    /**
     * Display a listing of the Categorias.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->categoriasRepository->pushCriteria(new RequestCriteria($request));
        $categorias = $this->categoriasRepository->all();

        return view('categorias.index')
            ->with('categorias', $categorias);
    }

    /**
     * Show the form for creating a new Categorias.
     *
     * @return Response
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Store a newly created Categorias in storage.
     *
     * @param CreateCategoriasRequest $request
     *
     * @return Response
     */
    public function store(CreateCategoriasRequest $request)
    {
        $input = $request->all();

        $categorias = $this->categoriasRepository->create($input);

        Flash::success('Categoría agregada exitosamente.');

        return redirect(route('categorias.index'));
    }

    /**
     * Display the specified Categorias.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        //$categorias = $this->categoriasRepository->findWithoutFail($id);
        $categorias = DB::select('
                SELECT c.id,c.descripcion, e.descripcion as elementos_id, c.icono,c.created_at,c.updated_at FROM categorias c, elementos e,  categorias_elementos ce
                WHERE c.id=ce.categorias_id AND e.id=ce.elementos_id AND c.id='.$id
        );
        if (empty($categorias)) {
            Flash::error('Categoría no encontrada');

            return redirect(route('categorias.index'));
        }

        return view('categorias.show')->with('categorias', $categorias);
    }

    /**
     * Show the form for editing the specified Categorias.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $categorias = $this->categoriasRepository->findWithoutFail($id);

        if (empty($categorias)) {
            Flash::error('Categoría no encontrada');

            return redirect(route('categorias.index'));
        }

        return view('categorias.edit')->with('categorias', $categorias);
    }

    /**
     * Update the specified Categorias in storage.
     *
     * @param  int              $id
     * @param UpdateCategoriasRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCategoriasRequest $request)
    {
        $categorias = $this->categoriasRepository->findWithoutFail($id);

        if (empty($categorias)) {
            Flash::error('Categoría no encontrada');

            return redirect(route('categorias.index'));
        }

        $categorias = $this->categoriasRepository->update($request->all(), $id);

        Flash::success('Categoría actualizada exitosamente.');

        return redirect(route('categorias.index'));
    }

    /**
     * Remove the specified Categorias from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $categorias = $this->categoriasRepository->findWithoutFail($id);

        if (empty($categorias)) {
            Flash::error('Categoría no encontrada');

            return redirect(route('categorias.index'));
        }

        $this->categoriasRepository->delete($id);

        Flash::success('Categoría eliminada exitosamente.');

        return redirect(route('categorias.index'));
    }
}
