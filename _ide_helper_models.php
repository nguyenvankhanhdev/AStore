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
 * 
 *
 * @property int $id
 * @property int $pro_id
 * @property int $sub_cate_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Products|null $product
 * @property-read \App\Models\SubCategories|null $subCategory
 * @method static \Illuminate\Database\Eloquent\Builder|Accessories newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Accessories newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Accessories query()
 * @method static \Illuminate\Database\Eloquent\Builder|Accessories whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Accessories whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Accessories whereProId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Accessories whereSubCateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Accessories whereUpdatedAt($value)
 */
	class Accessories extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $quantity
 * @property int $variant_color_id
 * @property int $user_id
 * @property int $pro_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Products|null $product
 * @property-read \App\Models\User|null $user
 * @property-read \App\Models\VariantColors|null $variant_color
 * @method static \Illuminate\Database\Eloquent\Builder|Carts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Carts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Carts query()
 * @method static \Illuminate\Database\Eloquent\Builder|Carts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Carts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Carts whereProId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Carts whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Carts whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Carts whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Carts whereVariantColorId($value)
 */
	class Carts extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Products> $products
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\SubCategories> $subCategories
 * @property-read int|null $sub_categories_count
 * @method static \Illuminate\Database\Eloquent\Builder|Categories newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Categories newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Categories query()
 * @method static \Illuminate\Database\Eloquent\Builder|Categories whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Categories whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Categories whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Categories whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Categories whereUpdatedAt($value)
 */
	class Categories extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\VariantColors> $variant
 * @property-read int|null $variant_count
 * @method static \Illuminate\Database\Eloquent\Builder|ColorProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ColorProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ColorProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|ColorProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorProduct whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColorProduct whereUpdatedAt($value)
 */
	class ColorProduct extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $cmt_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CommentLike newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommentLike newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CommentLike query()
 * @method static \Illuminate\Database\Eloquent\Builder|CommentLike whereCmtId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommentLike whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommentLike whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommentLike whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CommentLike whereUserId($value)
 */
	class CommentLike extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $content
 * @property int $cmt_likes
 * @property int $status
 * @property int $cmt_id
 * @property int $user_id
 * @property int $pro_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CommentLike> $commentLikes
 * @property-read int|null $comment_likes_count
 * @property-read \App\Models\Products|null $product
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Comments> $replies
 * @property-read int|null $replies_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Comments newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comments newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comments query()
 * @method static \Illuminate\Database\Eloquent\Builder|Comments whereCmtId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comments whereCmtLikes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comments whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comments whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comments whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comments whereProId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comments whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comments whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comments whereUserId($value)
 */
	class Comments extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property int $quantity
 * @property int $max_use
 * @property string $start_date
 * @property int $required_points
 * @property string $end_date
 * @property string $discount_type
 * @property float $discount
 * @property int $status
 * @property int $total_used
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Orders> $orders
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\UserCoupons> $usercoupons
 * @property-read int|null $usercoupons_count
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon query()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereMaxUse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereRequiredPoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereTotalUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereUpdatedAt($value)
 */
	class Coupon extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $province_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Provinces|null $province
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Wards> $wards
 * @property-read int|null $wards_count
 * @method static \Illuminate\Database\Eloquent\Builder|Districts newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Districts newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Districts query()
 * @method static \Illuminate\Database\Eloquent\Builder|Districts whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Districts whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Districts whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Districts whereProvinceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Districts whereUpdatedAt($value)
 */
	class Districts extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property-read \App\Models\FlashSales|null $flashsales
 * @property-read \App\Models\SubCategories|null $subcategories
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSaleItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSaleItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSaleItem query()
 */
	class FlashSaleItem extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $start_date
 * @property string $end_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FlashSaleItem> $flashsateitems
 * @property-read int|null $flashsateitems_count
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSales newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSales newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSales query()
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSales whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSales whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSales whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSales whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FlashSales whereUpdatedAt($value)
 */
	class FlashSales extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GeneralSetting query()
 */
	class GeneralSetting extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $message
 * @property int $seen
 * @property int $sender_id
 * @property int $received_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $receiver
 * @property-read \App\Models\User|null $sender
 * @method static \Illuminate\Database\Eloquent\Builder|Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message query()
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereReceivedId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereSeen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereSenderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereUpdatedAt($value)
 */
	class Message extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $quantity
 * @property float $total_price
 * @property int $variant_color_id
 * @property int $order_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Orders|null $orders
 * @property-read \App\Models\VariantColors|null $variantColors
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetails newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetails newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetails query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetails whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetails whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetails whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetails whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetails whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetails whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderDetails whereVariantColorId($value)
 */
	class OrderDetails extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property float $total_amount
 * @property string $address
 * @property string $status
 * @property string $order_date
 * @property string $payment_method
 * @property string $payment_status
 * @property int $user_id
 * @property int $coupon_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Coupon|null $coupon
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OrderDetails> $orderDetails
 * @property-read int|null $order_details_count
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Orders newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Orders newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Orders query()
 * @method static \Illuminate\Database\Eloquent\Builder|Orders whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orders whereCouponId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orders whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orders whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orders whereOrderDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orders wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orders wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orders whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orders whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orders whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Orders whereUserId($value)
 */
	class Orders extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $status
 * @property int $mode
 * @property string $country_name
 * @property string $currency_name
 * @property float $currency_rate
 * @property string $client_id
 * @property string $secret_key
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PaypalSettings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaypalSettings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaypalSettings query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaypalSettings whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaypalSettings whereCountryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaypalSettings whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaypalSettings whereCurrencyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaypalSettings whereCurrencyRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaypalSettings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaypalSettings whereMode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaypalSettings whereSecretKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaypalSettings whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaypalSettings whereUpdatedAt($value)
 */
	class PaypalSettings extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $pro_id
 * @property string $image
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Products|null $product
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages whereProId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductImages whereUpdatedAt($value)
 */
	class ProductImages extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $pro_id
 * @property int $storage_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Products|null $product
 * @property-read \App\Models\StorageProduct|null $storage
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\VariantColors> $variantColors
 * @property-read int|null $variant_colors_count
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariant query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariant whereProId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariant whereStorageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProductVariant whereUpdatedAt($value)
 */
	class ProductVariant extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $image
 * @property string|null $short_description
 * @property string|null $long_description
 * @property int $status
 * @property string|null $product_type
 * @property int $sub_cate_id
 * @property int $cate_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Accessories> $accessories
 * @property-read int|null $accessories_count
 * @property-read \App\Models\Categories|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Comments> $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OrderDetails> $orderDetails
 * @property-read int|null $order_details_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProductImages> $productImages
 * @property-read int|null $product_images_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Ratings> $ratings
 * @property-read int|null $ratings_count
 * @property-read \App\Models\SubCategories|null $subCategory
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProductVariant> $variants
 * @property-read int|null $variants_count
 * @method static \Illuminate\Database\Eloquent\Builder|Products newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Products newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Products query()
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereCateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereLongDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereProductType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereSubCateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Products whereUpdatedAt($value)
 */
	class Products extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Districts> $districts
 * @property-read int|null $districts_count
 * @method static \Illuminate\Database\Eloquent\Builder|Provinces newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Provinces newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Provinces query()
 * @method static \Illuminate\Database\Eloquent\Builder|Provinces whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provinces whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provinces whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Provinces whereUpdatedAt($value)
 */
	class Provinces extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property float $point
 * @property int $pro_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Products|null $product
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Ratings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ratings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ratings query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ratings whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ratings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ratings wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ratings whereProId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ratings whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ratings whereUserId($value)
 */
	class Ratings extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Statistic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Statistic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Statistic query()
 */
	class Statistic extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $GB
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProductVariant> $productVariant
 * @property-read int|null $product_variant_count
 * @method static \Illuminate\Database\Eloquent\Builder|StorageProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StorageProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StorageProduct query()
 * @method static \Illuminate\Database\Eloquent\Builder|StorageProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StorageProduct whereGB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StorageProduct whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StorageProduct whereUpdatedAt($value)
 */
	class StorageProduct extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int $cate_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Accessories> $accessories
 * @property-read int|null $accessories_count
 * @property-read \App\Models\Categories|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FlashSaleItem> $flashsaleitem
 * @property-read int|null $flashsaleitem_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Products> $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategories newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategories newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategories query()
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategories whereCateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategories whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategories whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategories whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategories whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubCategories whereUpdatedAt($value)
 */
	class SubCategories extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $name
 * @property string $email
 * @property string|null $phone
 * @property string|null $image
 * @property int|null $point
 * @property string|null $google_id
 * @property string|null $github_id
 * @property string $role
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @property-read \App\Models\UserAddress|null $userAddress
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\UserCoupons> $usercoupons
 * @property-read int|null $usercoupons_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGithubId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGoogleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePoint($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $address
 * @property int $user_id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $province
 * @property string $district
 * @property string $ward
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserAddress whereWard($value)
 */
	class UserAddress extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $coupon_id
 * @property int $quantity
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read \App\Models\Coupon|null $coupons
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserCoupons newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserCoupons newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserCoupons query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserCoupons whereCouponId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCoupons whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCoupons whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCoupons whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCoupons whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserCoupons whereUserId($value)
 */
	class UserCoupons extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $variant_id
 * @property int|null $color_id
 * @property int|null $quantity
 * @property int|null $price
 * @property int|null $offer_price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Carts> $carts
 * @property-read int|null $carts_count
 * @property-read \App\Models\ColorProduct|null $color
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OrderDetails> $orderDetails
 * @property-read int|null $order_details_count
 * @property-read \App\Models\ProductVariant|null $variant
 * @method static \Illuminate\Database\Eloquent\Builder|VariantColors newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VariantColors newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VariantColors query()
 * @method static \Illuminate\Database\Eloquent\Builder|VariantColors whereColorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariantColors whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariantColors whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariantColors whereOfferPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariantColors wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariantColors whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariantColors whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VariantColors whereVariantId($value)
 */
	class VariantColors extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $district_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Districts|null $district
 * @method static \Illuminate\Database\Eloquent\Builder|Wards newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wards newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wards query()
 * @method static \Illuminate\Database\Eloquent\Builder|Wards whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wards whereDistrictId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wards whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wards whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wards whereUpdatedAt($value)
 */
	class Wards extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $import_dae
 * @property int $total_quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\WarehouseDetails> $warehouseDetails
 * @property-read int|null $warehouse_details_count
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse query()
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereImportDae($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereTotalQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Warehouse whereUpdatedAt($value)
 */
	class Warehouse extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $warehouse_id
 * @property int $variant_color_id
 * @property int $quantity
 * @property float $warehouse_price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\VariantColors|null $variantColor
 * @property-read \App\Models\Warehouse|null $warehouse
 * @method static \Illuminate\Database\Eloquent\Builder|WarehouseDetails newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WarehouseDetails newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WarehouseDetails query()
 * @method static \Illuminate\Database\Eloquent\Builder|WarehouseDetails whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WarehouseDetails whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WarehouseDetails whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WarehouseDetails whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WarehouseDetails whereVariantColorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WarehouseDetails whereWarehouseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WarehouseDetails whereWarehousePrice($value)
 */
	class WarehouseDetails extends \Eloquent {}
}

