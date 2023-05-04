<?php

namespace App\Http\Controllers\Pages;

use App\Models\Food;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExampleController extends Controller
{
    public function index()
    {
        $records = $this->getData();
        return view('pages.example', [
            'totalNumber' => $records['total'],
            'data' => json_encode($records['data']),
            'header' => $this->getHeader(),
        ]);
    }

    public function edit($id)
    {
        return view('pages.example.edit', [
            'id' => $id,
            'data' => Food::find($id)
        ]);
    }

    private function getData()
    {
        $page = (int)request()->input(K_PAGE, V_PAGE);
        $perPage = (int)request()->input(K_PER_PAGE, V_PER_PAGE);
        $sortBy = request()->input(K_SORT_BY, 'name') ?? 'name';
        $direction = request()->input(K_DIRECTION, V_DIRECTION);
        $items = Food::orderBy(
            $sortBy === 'null' ? 'name' : $sortBy,
            $direction === 'false' ? 'desc' : 'asc'
        )
            ->paginate($perPage, ['*'], 'data', $page);
        return $items->toArray();
    }

    private function getHeader()
    {
        return json_encode([
            [
                'name' => 'name',
                'label' => 'Dessert (100g serving)',
                'align' => 'left',
                'field' => 'name',
                'sortable' => true
            ],
            [
                'name' => 'calories',
                'align' => 'center',
                'label' => 'Calories',
                'field' => 'calories',
                'sortable' => true
            ],
            [
                'name' => 'fat',
                'label' => 'Fat (g)',
                'field' => 'fat',
                'sortable' => true
            ],
            [
                'name' => 'carbs',
                'label' => 'Carbs (g)',
                'field' => 'carbs'
            ],
            [
                'name' => 'protein',
                'label' => 'Protein (g)',
                'field' => 'protein'
            ],
            [
                'name' => 'sodium',
                'label' => 'Sodium (mg)',
                'field' => 'sodium'
            ],
            [
                'name' => 'calcium',
                'label' => 'Calcium (%)',
                'field' => 'calcium',
                'sortable' => true,
                'sort' => function ($a, $b) {
                    return intval($a) - intval($b);
                }
            ],
            [
                'name' => 'iron',
                'label' => 'Iron (%)',
                'field' => 'iron',
                'sortable' => true,
                'sort' => function ($a, $b) {
                    return intval($a) - intval($b);
                }
            ],
            [
                'name' => 'actions',
                'align' => 'left',
                'label' => 'Action'
            ],
        ]);
    }
}
