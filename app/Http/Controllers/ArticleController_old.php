<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Article;


class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::paginate(2);

        // Статьи передаются в шаблон
        // compact('articles') => [ 'articles' => $articles ]
        return view('article.index', compact('articles'));
    }
    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('article.show', compact('article'));
    }
    public function create()
    {
        // Передаем в шаблон вновь созданный объект. Он нужен для вывода формы через Form::model
        $article = new Article();
        return view('article.create', compact('article'));
    }
    public function store(Request $request)
    {
        // Проверка введенных данных
        // Если будут ошибки, то возникнет исключение
        // Иначе возвращаются данные формы
        $data = $this->validate($request, [
            'name' => 'required|unique:articles',
            'body' => 'required|min:1000',
        ]);

        $article = new Article();
        // Заполнение статьи данными из формы
        $article->fill($data);
        // При ошибках сохранения возникнет исключение
        $article->save();

        // Редирект на указанный маршрут
        return redirect()
            ->route('articles.index');
    }
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('article.edit', compact('article'));
    }
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $data = $this->validate($request, [
        // У обновления немного измененная валидация. В проверку уникальности добавляется название поля и id текущего объекта
        // Если этого не сделать, Laravel будет ругаться на то что имя уже существует
        'name' => 'required|unique:articles,name,' . $article->id,
        'body' => 'required|min:100',
        ]);

        $article->fill($data);
        $article->save();
        return redirect()
         ->route('articles.index');
    }
    public function destroy($id)
    {
      // DELETE — идемпотентный метод, поэтому результат операции всегда один и тот же
      $article = Article::find($id);
       if ($article) {
        $article->delete();
        }
        return redirect()->route('articles.index');
    }
}
