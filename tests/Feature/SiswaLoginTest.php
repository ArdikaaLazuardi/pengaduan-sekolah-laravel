<?php

namespace Tests\Feature;

use App\Models\Siswa;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiswaLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_siswa_bisa_login_dengan_nis_yang_valid(): void
    {
        Siswa::query()->create([
            'nis' => '2025001',
            'nama' => 'Andi',
            'kelas' => 'XII RPL 1',
        ]);

        $response = $this->post(route('siswa.authenticate'), [
            'nis' => '2025001',
        ]);

        $response->assertRedirect(route('siswa.dashboard'));
        $this->assertAuthenticated('siswa');
    }
}
