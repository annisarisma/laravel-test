<h2>{{ $user->name }}</h2>

<b>Comments on their tasks:</b>
<ul>
    @foreach ($user->tasks as $task)
        @foreach ($task->comments as $comment)
            <li>{{ $comment->name }} ({{ $comment->comment }})</li>
        @endforeach
    @endforeach
</ul>
