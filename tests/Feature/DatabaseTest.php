<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\{Student, Person, Management, Payment, PaymentPlanData, PaymentPlan, Bill, BillData, User, FailedJob, PersonalAccessToken, PasswordResetToken, Campus, Career,};
use Illuminate\Support\Facades\Schema;

class DatabaseTest extends TestCase
{
    use RefreshDatabase;

    
    public function test_database_has_users_table()
    {
        $this->assertTrue(
            Schema::hasTable('users')
        );
    }

    public function test_can_create_student()
    {
        
        $person = Person::factory()->create();
        $management = Management::factory()->create();

        
        $student = Student::factory()->create([
            'person_id' => $person->id,
            'management_id' => $management->id,
        ]);

        $this->assertDatabaseHas('students', [
            'id' => $student->id,
            'email' => $student->email,
            'code' => $student->code,
        ]);
    }

    public function test_student_belongs_to_person()
    {
        $person = Person::factory()->create();
        $management = Management::factory()->create();

        $student = Student::factory()->create([
            'person_id' => $person->id,
            'management_id' => $management->id,
        ]);

        $this->assertEquals($person->id, $student->person->id);
    }

    public function test_student_belongs_to_management()
    {
        $person = Person::factory()->create();
        $management = Management::factory()->create();

        $student = Student::factory()->create([
            'person_id' => $person->id,
            'management_id' => $management->id,
        ]);

        $this->assertEquals($management->id, $student->management->id);
    }

    public function test_can_create_payment()
    {
        
        $student = Student::factory()->create();
        $paymentPlanData = PaymentPlanData::factory()->create();

        
        $payment = Payment::factory()->create([
            'student_id' => $student->id,
            'payment_plan_data_id' => $paymentPlanData->id,
        ]);

        $this->assertDatabaseHas('payments', [
            'id' => $payment->id,
            'ammount_payed' => $payment->ammount_payed,
            'date' => $payment->date,
        ]);
    }

    public function test_payment_belongs_to_student()
    {
        $student = Student::factory()->create();
        $paymentPlanData = PaymentPlanData::factory()->create();

        $payment = Payment::factory()->create([
            'student_id' => $student->id,
            'payment_plan_data_id' => $paymentPlanData->id,
        ]);

        $this->assertEquals($student->id, $payment->student->id);
    }

    public function test_payment_belongs_to_payment_plan_data()
    {
        $student = Student::factory()->create();
        $paymentPlanData = PaymentPlanData::factory()->create();

        $payment = Payment::factory()->create([
            'student_id' => $student->id,
            'payment_plan_data_id' => $paymentPlanData->id,
        ]);

        $this->assertEquals($paymentPlanData->id, $payment->paymentPlanData->id);
    }
}
