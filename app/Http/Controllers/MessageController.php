<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Contracts\View\View; //связь с вьювером
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;//состоит из двух частей: Request и Response
//Redirect – это перенаправление на другой url (напр, между двумя вьюверами: от create в index)
use Illuminate\Http\Request; //прочитывает всё содержимое форм из вьювера (напр. запрос POST)
use Illuminate\Http\Response;//ответ на запрос, который передается во вьювер
use Illuminate\Support\Facades\Auth; //подключение объекта авторизации
use Illuminate\Support\Facades\DB;//«Построитель запросов» - специальный фасад/класс который имитирует SQL-язык 

class MessageController extends Controller
{
    public function index(): View
    {
        // dd(Auth::user()->id);
        $messages["messages"] = DB::table("messages AS m")
                                    ->select("m.*", "u.last_name AS last_name", "u.name AS name")
                                    ->join("users AS u", "m.sender_id", "=", "u.id")//получаем из таблицы users имена отправителей вместо цифр id из таблицы mes
                                    ->where("m.recipient_id","=", Auth::user()->id)
                                    ->get();

        return view('messages.index', $messages);
    }    
    
    public function outbox(): View
    {
        $messages["messages"] = DB::table("messages AS m")
                                    ->select("m.*", "u.last_name AS last_name", "u.name AS name")
                                    ->join("users AS u", "m.recipient_id", "=", "u.id")//получаем из таблицы users имена получателей вместо цифр id из таблицы mes
                                    ->where("m.sender_id","=", Auth::user()->id)
                                    ->get();

        return view('messages.outbox', $messages);
    }
    
    public function create(): View
    {
        $users = User::all();
        return view('messages.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // проверяем данные формы
        $validatedData = $request->validate([
        'recipient_id' => 'required|exists:users,id',
        // другие правила проверки сообщений
        ]);
        
        $recipient_id = $request->input('recipient_id');
        $subject = $request->input('subject');
        $content = $request->input('content');

        // Create a new message
        $message = new Message;
        $message->recipient_id = $recipient_id;
        $message->subject = $subject;
        $message->content = $content; 
        $message->sender_id = auth()->id();
        $user = Auth::user(); //считываем текущего пользователя user из модели/класса Auth (это авто-модель Breeze) и сохраняем как user-а загрузившего изображение

        $message->save();

        return redirect()->route('messages.index');
    }

    /**
     * Display the specified resource.
     */

    public function show(string $id): View
    {
        return view('messages.show', [
            'message' => Message::getUserMessageByMessageId($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $message = Message::getUserMessageByMessageId($id);
        $message->delete();

        return redirect()->route('messages.index');


    }
}
