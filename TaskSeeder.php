<?php
namespace Database\Seeders;
use App\Models\Task;
use Illuminate\Database\Seeder;
class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $today=today();
        foreach ([
            ['Review Laravel migration notes','pending',$today],['Finish database query exercise','pending',$today],['Prepare assessment submission','pending',$today],['Check project README','done',$today],['Read Eloquent documentation','pending',$today->copy()->subDay()],['Organize course files','done',$today->copy()->subDays(2)],['Draft weekly study plan','pending',$today->copy()->addDay()],['Review controller structure','in progress',$today->copy()->addDays(2)],['Back up project files','pending',$today->copy()->addDays(3)],
        ] as [$title,$status,$date]) {
            Task::query()->create(['title'=>$title,'status'=>$status,'task_date'=>$date,'is_archived'=>false]);
        }
    }
}
