<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort = (!empty($sort_request = $request->get('sort'))) ? $sort_request : "updated_at";

        $order = (!empty($order_request = $request->get('order'))) ? $order_request : "DESC";

        $cards = Card::orderBy($sort, $order)->paginate(10)->withQueryString();
        return view('admin.cards.index', compact('cards', 'sort', 'order'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $card = new Card;
        return view('admin.cards.form', compact('card'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required|string|max:100',
            'text' => 'required|string',
            'image' => 'nullable|url',
        ],
        [
            'title.required' => 'Il titolo è obbligatorio',
            'title.string' => 'Il titolo deve essere una string',
            'title.max' => 'Il titolo non deve superare i 100 caratteri',
            'text.required' => 'Il testo è obbligatorio',
            'text.string' => 'Il testo deve essere una string',
            'image.url' => 'L\'immagine deve essere un\'url',
        ]
    );

        $card = new Card;
        $card->fill($request->all());
        $card->slug = Card::generateSlug($card->title);

        $card->save();

        return to_route('admin.cards.show', $card)->with('message_content', "Card $card->id creata con successo");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function show(Card $card)
    {
        return view('admin.cards.show', compact('card'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function edit(Card $card)
    {
        return view('admin.cards.form', compact('card'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Card $card)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'text' => 'required|string',
            'image' => 'nullable|url',
        ],
        [
            'title.required' => 'Il titolo è obbligatorio',
            'title.string' => 'Il titolo deve essere una string',
            'title.max' => 'Il titolo non deve superare i 100 caratteri',
            'text.required' => 'Il testo è obbligatorio',
            'text.string' => 'Il testo deve essere una string',
            'image.url' => 'L\'immagine deve essere un\'url',
        ]
    );

        $card->fill($request->all());
        $card->slug = Card::generateSlug($card->title);
        $card->save();

        return to_route('admin.cards.show', $card)->with('message_content', "Card $card->id modificata con successo");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function destroy(Card $card)
    {
        $id_card = $card->id;
        $card->delete();

        return to_route('admin.cards.index')
            ->with('message_type', "danger")
            ->with('message_content', "Card $id_card eliminato con successo");
    }
}