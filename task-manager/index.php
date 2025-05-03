<?php include('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
    <style>
        :root {
            --bg-color: #ffffff;
            --text-color: #333333;
            --container-bg: #ffffff;
            --form-bg: #f8f9fa;
            --task-bg: #ffffff;
            --border-color: #dddddd;
            --primary-color: #4e73df;
            --primary-hover: #3a5bd9;
            --danger-color: #e74c3c;
            --shadow: 0 4px 12px rgba(0,0,0,0.1);
            --task-shadow: 0 2px 4px rgba(0,0,0,0.05);
            --transition: all 0.3s ease;
        }

        .dark-mode {
            --bg-color: #121212;
            --text-color: #f5f5f5;
            --container-bg: #1e1e1e;
            --form-bg: #2d2d2d;
            --task-bg: #2d2d2d;
            --border-color: #444444;
            --primary-color: #5a67d8;
            --primary-hover: #4c51bf;
            --shadow: 0 4px 12px rgba(0,0,0,0.3);
            --task-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        body {
            font-family: 'Arial', sans-serif;
            background: var(--bg-color);
            color: var(--text-color);
            transition: var(--transition);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
        }

        /* Container Styling */
        .container {
            max-width: 600px;
            margin: 40px auto;
            padding: 30px;
            background: var(--container-bg);
            border-radius: 12px;
            box-shadow: var(--shadow);
            transition: var(--transition);
            animation: fadeIn 0.5s ease-out;
        }

        /* Header Styling */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            animation: slideDown 0.4s ease-out;
        }

        h1 {
            margin: 0;
            font-size: 2rem;
            color: var(--primary-color);
        }

        h2 {
            margin: 25px 0 15px;
            font-size: 1.5rem;
            color: var(--primary-color);
            animation: fadeIn 0.6s ease-out;
        }

        /* Form Styling */
        .form-container {
            background: var(--form-bg);
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            transition: var(--transition);
            animation: slideUp 0.5s ease-out;
        }

        /* Task Styling */
        .task {
            background: var(--task-bg);
            padding: 18px;
            margin: 15px 0;
            border-radius: 8px;
            box-shadow: var(--task-shadow);
            border-left: 4px solid var(--border-color);
            transition: var(--transition);
            animation: fadeIn 0.4s ease-out forwards;
            opacity: 0;
            transform: translateY(10px);
        }

        .task:nth-child(1) { animation-delay: 0.1s; }
        .task:nth-child(2) { animation-delay: 0.2s; }
        .task:nth-child(3) { animation-delay: 0.3s; }
        .task:nth-child(4) { animation-delay: 0.4s; }

        .task:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        }

        .task.completed {
            opacity: 0.6;
            text-decoration: line-through;
            background: var(--form-bg);
        }
        
        /* Priority Colors */
        .task.High { border-left-color: #ff6b6b; }
        .task.Medium { border-left-color: #ffd166; }
        .task.Low { border-left-color: #06d6a0; }
        
        /* Form Elements */
        input, textarea, select, button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-family: inherit;
            background: var(--container-bg);
            color: var(--text-color);
            transition: var(--transition);
        }

        textarea {
            min-height: 80px;
            resize: vertical;
        }

        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(78, 115, 223, 0.25);
        }
        
        button {
            background: var(--primary-color);
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: var(--transition);
            padding: 12px 20px;
        }
        
        button:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
        }

        .clear-btn {
            background: var(--danger-color);
        }

        .clear-btn:hover {
            background: #c0392b;
        }
        
        .due-date {
            color: var(--text-color);
            opacity: 0.8;
            font-size: 0.9em;
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .task-actions {
            margin-top: 15px;
            display: flex;
            gap: 15px;
        }

        .task-actions a {
            padding: 6px 12px;
            border-radius: 4px;
            transition: var(--transition);
            text-decoration: none;
        }

        .complete-btn {
            color: #06d6a0;
            border: 1px solid #06d6a0;
        }

        .complete-btn:hover {
            background: rgba(6, 214, 160, 0.1);
        }

        .delete-btn {
            color: var(--danger-color);
            border: 1px solid var(--danger-color);
        }

        .delete-btn:hover {
            background: rgba(231, 76, 60, 0.1);
        }

        /* Dark Mode Toggle */
        .dark-mode-toggle {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            padding: 8px 12px;
            border-radius: 20px;
            background: var(--form-bg);
            transition: var(--transition);
        }

        .dark-mode-toggle:hover {
            background: var(--border-color);
        }

        .toggle-icon {
            width: 20px;
            height: 20px;
            transition: var(--transition);
        }

        /* Footer */
        .footer {
            margin-top: 40px;
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
        }

        .footer a {
            color: var(--primary-color);
            text-decoration: none;
            transition: var(--transition);
        }

        .footer a:hover {
            text-decoration: underline;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive */
        @media (max-width: 640px) {
            .container {
                padding: 20px;
                margin: 20px auto;
            }
            
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Task Manager</h1>
            <div class="dark-mode-toggle" id="darkModeToggle">
                <svg class="toggle-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 16C14.2091 16 16 14.2091 16 12C16 9.79086 14.2091 8 12 8V16Z" fill="currentColor"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2ZM12 4V20C7.58172 20 4 16.4183 4 12C4 7.58172 7.58172 4 12 4Z" fill="currentColor"/>
                </svg>
                <span id="toggleText">Dark Mode</span>
            </div>
        </div>
        
        <div class="form-container">
            <form action="add_task.php" method="POST">
                <input type="text" name="title" placeholder="Task title" required>
                <textarea name="description" placeholder="Description (optional)" rows="3"></textarea>
                <input type="date" name="due_date">
                <select name="priority">
                    <option value="Low">Low Priority</option>
                    <option value="Medium" selected>Medium Priority</option>
                    <option value="High">High Priority</option>
                </select>
                <form action="add_task.php" method="POST">
    <!-- Existing fields... -->
    <input type="email" name="notification_email" placeholder="Email for reminders (optional)">
   
                <button type="submit">Add Task</button>
            </form>
        </div>
        
        <h2>Your Tasks</h2>
        <?php 
        $result = mysqli_query($conn, "SELECT * FROM tasks ORDER BY due_date ASC, is_completed ASC");
        
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $priorityClass = $row['priority'] ?? 'Medium';
                $completedClass = $row['is_completed'] ? 'completed' : '';
        ?>
                <div class="task <?php echo $priorityClass; ?> <?php echo $completedClass; ?>">
                    <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                    
                    <?php if(!empty($row['description'])): ?>
                        <p><?php echo htmlspecialchars($row['description']); ?></p>
                    <?php endif; ?>
                    
                    <?php if(!empty($row['due_date'])): ?>
                        <p class="due-date">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8 2V5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                <path d="M16 2V5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                <path d="M3.5 9.08997H20.5" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                <path d="M21 8.5V17C21 20 19.5 22 16 22H8C4.5 22 3 20 3 17V8.5C3 5.5 4.5 3.5 8 3.5H16C19.5 3.5 21 5.5 21 8.5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M15.6947 13.7H15.7037" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M15.6947 16.7H15.7037" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M11.9955 13.7H12.0045" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M11.9955 16.7H12.0045" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M8.29431 13.7H8.30329" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M8.29431 16.7H8.30329" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            Due: <?php echo $row['due_date']; ?>
                        </p>
                    <?php endif; ?>
                    
                    <div class="task-actions">
                        <a href="complete_task.php?id=<?php echo $row['id']; ?>" class="complete-btn">✓ Complete</a>
                        <a href="delete_task.php?id=<?php echo $row['id']; ?>" class="delete-btn">✗ Delete</a>
                    </div>
                </div>
            <?php } ?>
        <?php } else { ?>
            <div class="task" style="text-align: center; padding: 30px;">
                <p>No tasks found. Add your first task above!</p>
            </div>
        <?php } ?>
        
        <?php if (mysqli_num_rows($result) > 0): ?>
            <form action="clear_completed.php" method="POST">
                <button type="submit" class="clear-btn" style="margin-top: 30px;">
                    🗑️ Clear Completed Tasks
                </button>
            </form>
        <?php endif; ?>

        <footer class="footer">
            <a href="about.php">About This App</a>
        </footer>
    </div>

    <script>
        // Dark Mode Toggle
        const darkModeToggle = document.getElementById('darkModeToggle');
        const toggleText = document.getElementById('toggleText');
        const body = document.body;
        
        // Check for saved user preference
        const currentTheme = localStorage.getItem('theme');
        if (currentTheme === 'dark') {
            body.classList.add('dark-mode');
            toggleText.textContent = 'Light Mode';
        }
        
        // Toggle dark/light mode
        darkModeToggle.addEventListener('click', () => {
            body.classList.toggle('dark-mode');
            const isDark = body.classList.contains('dark-mode');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            toggleText.textContent = isDark ? 'Light Mode' : 'Dark Mode';
        });
        
        // Animation for form elements
        const inputs = document.querySelectorAll('input, textarea, select');
        inputs.forEach((input, index) => {
            input.style.transitionDelay = `${index * 0.05}s`;
        });
    </script>
</body>
</html>