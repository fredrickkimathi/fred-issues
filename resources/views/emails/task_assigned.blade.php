<!DOCTYPE html>
<html>
<head>
    <title>New Task Assigned</title>
</head>
<body>
    <h1>Hello {{ $task->user->name }},</h1>
    <p>You have been assigned a new task.</p>
    <p><strong>Task:</strong> {{ $task->issue->name }}</p>
    <p><strong>Description:</strong> {{ $task->issue->description }}</p>
    <p><strong>System:</strong> {{ $task->issue->system->name }}</p>
    <p>Please log in to your dashboard to view more details.</p>
</body>
</html>
