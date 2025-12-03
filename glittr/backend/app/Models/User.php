<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\ProductReview;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image',
        'is_premium',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_premium' => 'boolean',
        ];
    }

    public function productReviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function getProfileImageUrlAttribute()
    {
        if ($this->profile_image) {
            return asset('storage/' . $this->profile_image);
        }
        
        // Retorna a logo do sistema como padrão
        $hostname = request()->getHost();
        $baseUrl = (in_array($hostname, ['localhost', '127.0.0.1'])) 
            ? 'http://127.0.0.1:8080' 
            : 'https://glittr.com.br';
        return $baseUrl . '/src/assets/icons/LogoGlittr.svg';
    }

    public function getShortNameAttribute()
    {
        $name = trim($this->name);
        $parts = explode(' ', $name);
        
        // Remove títulos do início
        $titles = ['Sr.', 'Sra.', 'Srta.', 'Dr.', 'Dra.', 'Prof.', 'Profa.'];
        
        while (!empty($parts) && in_array($parts[0], $titles)) {
            array_shift($parts);
        }
        
        return !empty($parts) ? $parts[0] : $name;
    }
}
