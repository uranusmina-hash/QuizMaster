<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Question;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'full_name' => 'System Administrator',
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);


        Question::create([
            'question' => 'What does OOP stand for in programming?',
            'option1' => 'Object Oriented Programming',
            'option2' => 'Open Online Protocol',
            'option3' => 'Operational Objective Process',
            'option4' => 'Optimized Output Programming',
            'answer' => 1,
        ]);

        Question::create([
            'question' => 'Which of the following is NOT a principle of OOP?',
            'option1' => 'Encapsulation',
            'option2' => 'Inheritance',
            'option3' => 'Compilation',
            'option4' => 'Polymorphism',
            'answer' => 3,
        ]);

        Question::create([
            'question' => 'In Laravel, what is the purpose of Eloquent?',
            'option1' => 'To handle routing',
            'option2' => 'To interact with databases using ORM',
            'option3' => 'To manage sessions',
            'option4' => 'To compile Blade templates',
            'answer' => 2,
        ]);

        Question::create([
            'question' => 'What design pattern does Laravel primarily follow?',
            'option1' => 'Singleton Pattern',
            'option2' => 'Factory Pattern',
            'option3' => 'MVC Pattern',
            'option4' => 'Observer Pattern',
            'answer' => 3,
        ]);

        Question::create([
            'question' => 'Which Laravel command is used to create a new model?',
            'option1' => 'php artisan make:model',
            'option2' => 'php artisan create:model',
            'option3' => 'php artisan new:model',
            'option4' => 'php artisan generate:model',
            'answer' => 1,
        ]);

        Question::create([
            'question' => 'What is encapsulation in OOP?',
            'option1' => 'Creating multiple instances of a class',
            'option2' => 'Hiding internal details and showing only functionality',
            'option3' => 'Inheriting properties from parent class',
            'option4' => 'Overriding methods in child class',
            'answer' => 2,
        ]);

        Question::create([
            'question' => 'In Laravel, what file contains application routes?',
            'option1' => 'app.php',
            'option2' => 'routes.php',
            'option3' => 'web.php',
            'option4' => 'index.php',
            'answer' => 3,
        ]);

        Question::create([
            'question' => 'Which OOP concept allows a class to inherit properties from another class?',
            'option1' => 'Abstraction',
            'option2' => 'Inheritance',
            'option3' => 'Encapsulation',
            'option4' => 'Polymorphism',
            'answer' => 2,
        ]);

        Question::create([
            'question' => 'What is the default database driver in Laravel?',
            'option1' => 'PostgreSQL',
            'option2' => 'SQLite',
            'option3' => 'MySQL',
            'option4' => 'MongoDB',
            'answer' => 3,
        ]);

        Question::create([
            'question' => 'What does the "protected" keyword mean in OOP?',
            'option1' => 'Accessible only within the same class',
            'option2' => 'Accessible from anywhere',
            'option3' => 'Accessible within the class and its subclasses',
            'option4' => 'Not accessible at all',
            'answer' => 3,
        ]);

        Question::create([
            'question' => 'In Laravel, what is middleware used for?',
            'option1' => 'To style views',
            'option2' => 'To filter HTTP requests',
            'option3' => 'To create database tables',
            'option4' => 'To compile assets',
            'answer' => 2,
        ]);

        Question::create([
            'question' => 'What is polymorphism in OOP?',
            'option1' => 'Using multiple databases',
            'option2' => 'Having multiple constructors',
            'option3' => 'Ability to take multiple forms',
            'option4' => 'Creating multiple instances',
            'answer' => 3,
        ]);

        Question::create([
            'question' => 'Which Laravel feature is used for database migrations?',
            'option1' => 'Seeder',
            'option2' => 'Migration',
            'option3' => 'Factory',
            'option4' => 'Schema',
            'answer' => 2,
        ]);

        Question::create([
            'question' => 'What is a constructor in OOP?',
            'option1' => 'A method to delete objects',
            'option2' => 'A method called when object is created',
            'option3' => 'A method to copy objects',
            'option4' => 'A method to compare objects',
            'answer' => 2,
        ]);

        Question::create([
            'question' => 'In Laravel, what does "php artisan migrate" do?',
            'option1' => 'Creates a new migration file',
            'option2' => 'Runs all pending migrations',
            'option3' => 'Rolls back migrations',
            'option4' => 'Seeds the database',
            'answer' => 2,
        ]);
    }
}