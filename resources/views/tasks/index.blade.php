@extends('layouts.app')

@section('content')

    <h1>タスク一覧</h1>

    @if (count($user->tasks) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>ステータス</th>
                    <th>タスク</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->tasks as $task)
                <tr>
                    <td>{!! link_to_route('tasks.show', $task->id, ['task' => $task->id]) !!}</td>
                    <td>{{ $task->status }}</td>
                    <td>{{ $task->content }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    
   
    {{-- タスク作成ページのリンク --}}
    {!! link_to_route('tasks.create', '新規タスクの登録', [], ['class' => 'btn btn-success']) !!}
   
@endsection