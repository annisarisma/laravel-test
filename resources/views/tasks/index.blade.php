<ul>
    @foreach ($tasks as $task)
        {{ $task->name }} ({{ optional($task->user)->name }})
    @endforeach
</ul>
{{ $tasks->links() }}
