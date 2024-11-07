<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\JenisUsaha
 *
 * @property int $id
 * @property string $jenis_usaha
 * @property string|null $icon
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Usaha> $usaha
 * @property-read int|null $usaha_count
 * @method static \Illuminate\Database\Eloquent\Builder|JenisUsaha newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JenisUsaha newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JenisUsaha query()
 * @method static \Illuminate\Database\Eloquent\Builder|JenisUsaha whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JenisUsaha whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JenisUsaha whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JenisUsaha whereJenisUsaha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JenisUsaha whereUpdatedAt($value)
 */
	class JenisUsaha extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Kategori
 *
 * @property int $id
 * @property string $nama_kategori
 * @property string|null $icon
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Usaha> $usaha
 * @property-read int|null $usaha_count
 * @method static \Illuminate\Database\Eloquent\Builder|Kategori newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kategori newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kategori query()
 * @method static \Illuminate\Database\Eloquent\Builder|Kategori whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kategori whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kategori whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kategori whereNamaKategori($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kategori whereUpdatedAt($value)
 */
	class Kategori extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Produk
 *
 * @property int $id
 * @property int $usaha_id
 * @property string $nama_produk
 * @property string $tipe_produk
 * @property int $harga
 * @property string $ekspor
 * @property string $deskripsi
 * @property string|null $foto
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Usaha|null $usaha
 * @method static \Illuminate\Database\Eloquent\Builder|Produk newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Produk newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Produk query()
 * @method static \Illuminate\Database\Eloquent\Builder|Produk whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produk whereDeskripsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produk whereEkspor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produk whereFoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produk whereHarga($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produk whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produk whereNamaProduk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produk whereTipeProduk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produk whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Produk whereUsahaId($value)
 */
	class Produk extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Setting
 *
 * @property int $id
 * @property string $name
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereValue($value)
 */
	class Setting extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Usaha
 *
 * @property int $id
 * @property int $user_id
 * @property int $kategori_id
 * @property int $jenis_usaha_id
 * @property string $nama_usaha
 * @property string $alamat
 * @property string $deskripsi
 * @property string|null $website
 * @property string|null $link_maps
 * @property string|null $logo
 * @property int $isVerified
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\JenisUsaha|null $jenis_usaha
 * @property-read \App\Models\Kategori|null $kategori
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Produk> $produk
 * @property-read int|null $produk_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Usaha newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Usaha newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Usaha query()
 * @method static \Illuminate\Database\Eloquent\Builder|Usaha whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Usaha whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Usaha whereDeskripsi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Usaha whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Usaha whereIsVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Usaha whereJenisUsahaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Usaha whereKategoriId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Usaha whereLinkMaps($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Usaha whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Usaha whereNamaUsaha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Usaha whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Usaha whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Usaha whereWebsite($value)
 */
	class Usaha extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $no_hp
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $two_factor_confirmed_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNoHp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutRole($roles, $guard = null)
 */
	class User extends \Eloquent {}
}

