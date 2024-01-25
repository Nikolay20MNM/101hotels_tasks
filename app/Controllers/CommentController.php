<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Comment;
use CodeIgniter\HTTP\ResponseInterface;

class CommentController extends BaseController
{
    public function index()
    {
        // Создаем объект модели
        $commentModel = new Comment();

        // Получаем значение для сортировки
        $sort_by = $this->request->getGet('sort_by');

        // Установлено ли значение
        if ($sort_by) {
            // Выбираем сортировку
            switch ($sort_by) {
                case 'id_asc':
                    // Получение комментариев с использованием пагинации (paginate(3))
                    $comments = $commentModel->orderBy('id', 'ASC')->paginate(3);
                    break;
                case 'id_desc':
                    $comments = $commentModel->orderBy('id', 'DESC')->paginate(3);
                    break;
                case 'created_at_asc':
                    $comments = $commentModel->orderBy('created_at', 'ASC')->paginate(3);
                    break;
                case 'created_at_desc':
                    $comments = $commentModel->orderBy('created_at', 'DESC')->paginate(3);
                    break;
                default:
                    $comments = $commentModel->paginate(3);
                    break;
            }
        } else {
            $comments = $commentModel->paginate(3);
        }

        $data = [
            'comments' => $comments,
            'pager' => $commentModel->pager,
        ];

        // Передача данных в представление
        return view('index', $data);
    }

    public function store()
    {
        // Создаем объект модели
        $commentModel = new Comment();

        // Валидация
        $rules = [
            'name' => 'required|valid_email',
            'text' => 'required'
        ];

        // Если не прошла валидация, то записываем ошибки
        if (!$this->validate($rules)) {
            return redirect()->back()->with('storeError', $this->validator);
        } else {
            // Вставляем записи в БД
            $commentModel->insert([
                'name' => $this->request->getPost('name'),
                'text'  => $this->request->getPost('text'),
            ]);
            // Флаг, что все прошло успешно
            return redirect()->back()->with('storeSuccess', 'Комментарий успешно добавлен!');
        }
    }

    public function delete($id)
    {
        // Создаем объект модели
        $commentModel = new Comment();
        // Находим запись по id, которую нужно удалить
        $comment = $commentModel->find($id);

        // Если найдена, то удаляем и редиректим
        if ($comment) {
            $commentModel->delete($id);
            return redirect()->back()->with('deleteSuccess', 'Запись успешно удалена.');
        } else {
            return redirect()->back()->with('deleteError', 'Ошибка удаления записи.');
        }
    }
}
