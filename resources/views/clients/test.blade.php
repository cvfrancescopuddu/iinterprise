<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <h3>Urgente</h3>
        <ul>
            @foreach($urgentTasks as $task)
                <li>
                    <input type="checkbox" id="task-{{ $task->id }}" name="tasks[]">
                    <label for="task-{{ $task->id }}">{{ $task->description }}</label>
                </li>
            @endforeach
        </ul>

        <h3>Importante</h3>
        <ul>
            @foreach($importantTasks as $task)
                <li>
                    <input type="checkbox" id="task-{{ $task->id }}" name="tasks[]">
                    <label for="task-{{ $task->id }}">{{ $task->description }}</label>
                </li>
            @endforeach
        </ul>

        <h3>Normale</h3>
        <ul>
            @foreach($normalTasks as $task)
                <li>
                    <input type="checkbox" id="task-{{ $task->id }}" name="tasks[]">
                    <label for="task-{{ $task->id }}">{{ $task->description }}</label>
                </li>
            @endforeach
        </ul>
    </div>
</div>