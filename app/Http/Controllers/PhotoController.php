<?php

namespace App\Http\Controllers;

use App\Models\Photo; //связь с моделью
use App\Models\User;
use Illuminate\Contracts\View\View; //связь с вьювером
use Illuminate\Http\RedirectResponse;//состоит из двух частей: Request и Response
//Redirect – это перенаправление на другой url (напр, между двумя вьюверами: от create в index)
use Illuminate\Http\Request; //прочитывает всё содержимое форм из вьювера (напр. запрос POST)
use Illuminate\Http\Response;//ответ на запрос, который передается во вьювер
use Illuminate\Support\Facades\Auth; //подключение объекта авторизации
use Illuminate\Database\Eloquent\Builder;//не поняла зачем?


class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     * Отобразить список изображений.
     */
    public function index(): View
    {       
        // dd(Auth::user()->id);
        return view('photos.index', [
            'photos' => Photo::getUserPhoto()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * Показать форму для добавления нового изображения.
     */
    public function create(): View
    {
        return view('photos.create', []);
    }

    /**
     * Store a newly created resource in storage.
     * Сохранить вновь добавленное изображение в БД.
     */
    public function store(Request $request): RedirectResponse
    {
        //Получить данные из запроса
        $title = $request->input('title');
        $description = $request->input('title');
        
         //Создать новый экземпляр/объект модели Photo и поместить запрошенные данные в соответствующий столбец БД.
        $photo = new Photo();
        $photo->title = $title;
        $photo->description = $description; //данные, записываемые в alt     
       
        // Save the image. 
        $path = $request->file('path')->store('photos', 'public');
        $photo->path = $path;
      
       // Set user
       $user = Auth::user(); //считываем текущего пользователя user из модели/класса Auth (это авто-модель Breeze) и сохраняем как user-а загрузившего изображение
       $photo->user()->associate($user);
        //associate – это метод, который в таблице сохраняет id, это метод взаимосвязей (один ко многим, многие ко многим), он автоматом определяет и присваивает нужные id на основе заранее прописанных нами связей.

       //сохранить новое изображение
       $photo->save();

       //возврат на страницу изображений
       return redirect()->route('photos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        return view('photos.show', [
            'photo' => Photo::getUserPhotoByPhotoId($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        return view('photos.edit', [
            'photo' => Photo::getUserPhotoByPhotoId($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $photo = Photo::getUserPhotoByPhotoId($id);

         // Get the data from the request
        //  Получить данные из запроса
        $title = $request->input('title');
        $description = $request->input('title');

         // Update photo info
         $photo->title = $title;
         $photo->description = $description; //данные, записываемые в alt   

        //сохранить новое изображение
        $photo->save();

       //возврат на страницу изображений
       return redirect()->route('photos.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        {
            // $photo = Photo::all()->find($id);
            $photo = Photo::getUserPhotoByPhotoId($id);
            $photo->delete();
    
            return redirect()->route('photos.index');
        }
    }
}
