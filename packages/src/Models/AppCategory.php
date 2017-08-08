<?php
/**
 * Created by PhpStorm.
 * User: Peace-N
 * Date: 7/25/2017
 * Time: 10:35 AM
 */
namespace EONConsulting\AppStore\Models;


use Illuminate\Database\Eloquent\Model;
use EONConsulting\LaravelLTI\Models\LTIDomain;
use App\Models\User;

class AppCategory extends Model {

    protected $table = 'lti_app_categories';

    protected $fillable = [
        'creator_id', 'title', 'description'
    ];

    public function creator() {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }
    /**
     * Get the Apps in this Category
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function apps() {
        return $this->hasMany(LTIDomain::class, 'category_id');
    }

}