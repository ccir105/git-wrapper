# Project Management Wrapper For Laravel

### Installation

- Extract to root of laravel project so it will have following structure

```
	root
	----packages/
		----shokse/
			----githubapi/
				----src/
					---- config/
						---- config.php
					---- facades/
						---- ProjectManagerFacade.php
						---- TaskManagerFacade.php
					---- Git/
						---- GIT.php
						---- CustomGit.php
						---- GitInterface.php
					---- Logger
						---- Database.php
						---- FileSystem.php
						---- LoggerInterface.php
					---- Migration
						---- AddGitLogTable.php
					---- Models
						---- Company.php
						---- GitLog.php
						---- Project.php
						---- Student.php
						---- Task.php
						---- User.php
					---- ProjectApiServiceProvider.php
					---- ProjectManager.php
					---- TaskManager.php
				---- README
				---- composer.json
```

- Open app.php in config folder and set this line to `provider`
```php
    Shokse\ProjectApi\ProjectApiServiceProvider::class,
```
- Also setup facade to the `aliases` array. Paste the below codes in `aliases`

```php
    'ProjectManager' => Shokse\ProjectApi\Facades\ProjectManagerFacade::class,
        'TaskManager' => Shokse\ProjectApi\Facades\TaskManagerFacade::class
```

- Set autoload in composer.json in root folder. Paste this line and place it in `autoload` section inside `psr-4` object

```php
       "Shokse\\ProjectApi\\": "packages/Shokse/ProjectApi/src",
```

- Copy project.php file located in `src\config\project.php` in packages folder to root/config folder

- Finally run this command to detect the new library classes

	```composer dump-autoload```

## Config

It use the simple configuration array values for prefix while making repositories and branch :
You can customize by your own way
*project repository name  `project-{projectId}`
*project task branch name `branch-{taskId}`
*assigned task branch name `branch-{taskid}-user-{userId}`
```php
'prefix' => [
        'project' => 'project-%d',
        'task' => 'branch-%d-init',
        'assigned_task'=>'branch-%d-user-%d'
    ]
```

## How to use
The two Facade `ProjectManager` and `TaskManager` has wrapped with git hub api and database queries so we can perform all operation by calling functions

### Basic Api

This basically pulls all the projects `repositories` from database and returns collection
```php
ProjectManager::all()
```

This saves a new project and call git create repository api and log on different logProvider
```php
ProjectManager::save($inputArray, $companyModel)
```

Deletes the project
```php
ProjectManager::remove($projectModel)
```

Creates a new task (a new branch)
```php
TaskManager::save($inputArray, $projectModel)
```
Removes the task

```php
TaskManager::remove($taskModel)
```
Assign the task to the passed `$studentModel`

```php
TaskManager::assign($taskModel, $studentModel)
```
Submit the task after the developer finish

```php
TaskManager::submit($taskModel,$studentModel)
```
Accept the task after properly checked request by `$studentModel` user
```php
TaskManager::accept($taskModel , $studentModel)
```

### Integrating git library
As we are using git interacting library, and it has not already developed a GitInterface.php holds the contract which should be implemented in class [Demo `CustomGit.php`] and call any git library properly as per the function defination. The interface is bounded in the container through  ProjectApiServiceProvider.php. We can bind the concrete class after the git library difination developed
Function to be implemented
* `createRepository($name)`
* `deleteRepostory($name)`
* `createBranch($name, $branchName)`
* `forkBranch($name, $source, $new)`
* `deleteBranch($name, $branch)`
* `commit`($name, $branch, $message);`

###Logger Loggin Git Actions
Every Action with git is logged. Two log drivers are available, `filesystem`, `database`

We can define in config as per the requirement
```php
'log-driver' => 'database'
```
To use database driver we need to run migration. Copy the migration file `AddGitLogTable.php` into database\migrations and run `php artisan migrate`

### Important note

Last thing

This code assume that the task , project , company, and student should be related in model function
You can reference these code and past these lines of proper file to run properly

In `Task.php`
```php
   public function project(){
        return $this->belongsTo('Shokse\ProjectApi\Models\Project');
    }

    public function users(){
        return $this-&gt;belongsToMany('Shokse\ProjectApi\Models\Student','student_tasks','task_id','student_id');
    }

public function isAssignedTo($user){
        $programmers = $this->users;
        return in_array($user->id,$programmers->lists('id')->toArray());
    }

```
In `Company.php`
```php
public function user(){
        return $this->hasOne('Shokse\ProjectApi\Models\User');
    }
```
In `Project.php`
```php
public function company(){
        return $this->belongsTo('Shokse\ProjectApi\Models\User','company_id','id');
    }

    public function tasks(){
        return $this->belongsTo('Shokse\ProjectApi\Models\Task');
    }
```


### Best Regards