# شرح مشروع Green Market بلغة PHP

هذا الملف هو نسخة عربية مبسطة من `TUTORIAL.md`. الهدف منه هو مساعدة طالب مبتدئ في PHP على فهم الأفكار المستعملة داخل المشروع، مثل الصفحات، الاتصال بقاعدة البيانات، الجلسات، الصلاحيات، الحلقات، والدوال.

## 1. صفحات PHP

معظم صفحات المشروع هي ملفات PHP تقوم بإخراج HTML.

أمثلة:

- `index.php`
- `pages/products.php`
- `pages/categories.php`
- `pages/admin-dashboard.php`
- `pages/client-dashboard.php`
- `pages/producer-dashboard.php`

ملف PHP يمكن أن يحتوي على:

- HTML
- متغيرات PHP
- استعلامات قاعدة البيانات
- حلقات
- شروط
- ملفات مضافة بواسطة `include` أو `require`

مثال بسيط:

```php
<?php
$title = 'Green Market';
?>

<h1><?= $title ?></h1>
```

الكتابة `<?= ... ?>` هي طريقة قصيرة لطباعة قيمة داخل HTML.

## 2. الاتصال بقاعدة البيانات بواسطة PDO

الاتصال بقاعدة البيانات موجود في:

```txt
config/database.php
```

المشروع يستعمل PDO، وهي أداة في PHP للتعامل مع قواعد البيانات.

```php
$pdo = new PDO(
    "mysql:host={$DB_HOST};dbname={$DB_NAME};charset=utf8mb4",
    $DB_USER,
    $DB_PASS
);
```

بعد إضافة هذا الملف، يمكن للصفحات الأخرى استعمال المتغير `$pdo` لتنفيذ استعلامات SQL.

مثال:

```php
$stmt = $pdo->query('SELECT ID_Categ, nom_Categ FROM categorie ORDER BY nom_Categ');
$categories = $stmt->fetchAll();
```

هذا يعني:

- نفذ استعلام SQL
- اجلب كل النتائج
- خزّنها داخل المتغير `$categories`

## 3. `require_once` وإضافة الملفات

بدل تكرار نفس الكود في كل صفحة، نستعمل ملفات مشتركة.

مثال:

```php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/view_helpers.php';
```

`require_once` تعني:

- أضف هذا الملف
- إذا كان الملف مضافا من قبل، لا تضفه مرة ثانية
- إذا كان الملف غير موجود، أوقف الصفحة وأظهر خطأ

نستعمل الملفات المشتركة من أجل:

- الاتصال بقاعدة البيانات
- دوال الجلسة
- الصلاحيات
- أجزاء HTML المتكررة
- دوال مساعدة

مثال من لوحة الإدارة:

```php
require __DIR__ . '/admin/sections.php';
```

هذا الملف يقوم بتحميل أقسام لوحة الإدارة من المجلد `pages/admin/sections/`.

## 4. الدوال المساعدة

الدوال المساعدة موجودة في:

```txt
includes/view_helpers.php
```

هذه الدوال تساعدنا على عدم تكرار نفس الكود.

### الدالة `e()`

```php
function e(?string $value): string {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
```

هذه الدالة تجعل طباعة النص داخل HTML أكثر أمانا.

مثال:

```php
<?= e($product['nom_Prod']) ?>
```

لماذا نستعملها؟ إذا كتب مستخدم كود HTML أو JavaScript خطير، الدالة `e()` تمنع تنفيذه وتعرضه كنص عادي.

### الدالة `asset_url()`

هذه الدالة تنشئ مسار الصور.

```php
asset_url($product['Prod_img'])
```

إذا كان مسار الصورة فارغا، ترجع صورة افتراضية.

### الدالة `format_price()`

هذه الدالة تنسق السعر.

```php
format_price(120)
```

الناتج:

```txt
120 MAD
```

### الدالة `format_date_fr()`

هذه الدالة تنسق التاريخ باللغة الفرنسية.

```php
format_date_fr('2026-06-13 17:00:00')
```

مثال على الناتج:

```txt
13 Juin 2026
```

## 5. الجلسات Sessions

الجلسات تسمح لـ PHP بتذكر المستخدم بعد تسجيل الدخول.

ملفات الجلسة موجودة في:

```txt
includes/session.php
```

الجلسة تحفظ بيانات على الخادم. مثلا بعد تسجيل الدخول، نخزن معلومات المستخدم داخل `$_SESSION`.

مثال:

```php
$_SESSION['user'] = [
    'id' => $user['ID_utili'],
    'role' => $user['role'],
    'email' => $user['email'],
];
```

بعد ذلك، في صفحة أخرى، نستطيع معرفة المستخدم الحالي.

مثال:

```php
$user = current_user();
```

الجلسات تستعمل من أجل:

- تسجيل الدخول
- تسجيل الخروج
- حماية لوحات التحكم
- معرفة دور المستخدم
- عرض بيانات البروفايل المناسبة

## 6. تسجيل الدخول وتسجيل الخروج

تسجيل الدخول يتم في:

```txt
actions/login.php
```

الأفكار المهمة في هذا الملف:

- قراءة البريد وكلمة المرور من `POST`
- البحث عن المستخدم في جدول `utilisateur`
- التحقق من كلمة المرور بواسطة `password_verify()`
- حفظ بيانات المستخدم في الجلسة
- توجيه المستخدم حسب دوره

تسجيل الخروج يتم في:

```txt
actions/logout.php
```

تسجيل الخروج يمسح الجلسة حتى لا يبقى المستخدم متصلا.

## 7. الصلاحيات Permissions

الصلاحيات معرفة في:

```txt
includes/permissions.php
```

الفكرة بسيطة:

- admin يدخل إلى لوحة الإدارة
- producteur يدخل إلى لوحة المنتج
- client يدخل إلى لوحة العميل

مثال:

```php
require_permission('admin.dashboard');
```

هذا يعني:

```txt
فقط المستخدم الذي يملك صلاحية admin.dashboard يمكنه فتح الصفحة.
```

إذا لم يكن لدى المستخدم الصلاحية، يتم منعه أو توجيهه إلى صفحة أخرى.

هذا يجعل الصفحات أكثر أمانا.

## 8. النماذج و `$_POST`

النماذج ترسل البيانات إلى PHP.

مثال:

```php
<form method="post">
    <input name="nom" type="text">
    <button type="submit">Enregistrer</button>
</form>
```

في PHP نقرأ القيمة هكذا:

```php
$nom = $_POST['nom'] ?? '';
```

الجزء `?? ''` يعني:

```txt
إذا لم تكن القيمة موجودة، استعمل نصا فارغا.
```

هذا يساعد على تجنب الأخطاء.

## 9. معاملات الرابط و `$_GET`

`$_GET` تقرأ القيم الموجودة في الرابط.

مثال رابط:

```txt
products.php?categorie=2&prix=50-150
```

في PHP:

```php
$categoryFilter = $_GET['categorie'] ?? null;
$priceFilter = $_GET['prix'] ?? null;
```

في `pages/products.php` نستعمل هذا من أجل الفلاتر:

- التصنيف
- المتجر أو التعاونية
- السعر
- التتبع
- الترتيب

## 10. استعلامات SQL

المشروع يستعمل SQL لقراءة وتعديل البيانات.

### استعلام بسيط

```php
$categories = $pdo->query('SELECT * FROM categorie')->fetchAll();
```

هذا مناسب عندما لا يوجد إدخال من المستخدم.

### استعلام محضر Prepared Statement

عندما نستعمل بيانات من المستخدم، نستعمل الاستعلامات المحضرة:

```php
$stmt = $pdo->prepare('SELECT * FROM produit WHERE ID_Categ = ?');
$stmt->execute([$categoryId]);
$products = $stmt->fetchAll();
```

الاستعلامات المحضرة تساعد على الحماية من SQL Injection.

## 11. الحلقات Loops

الحلقات تستعمل لعرض عدة نتائج من قاعدة البيانات.

مثال:

```php
<?php foreach ($products as $product): ?>
    <h3><?= e($product['nom_Prod']) ?></h3>
    <p><?= e(format_price($product['Prix'])) ?></p>
<?php endforeach; ?>
```

هذا يعني:

- لكل منتج داخل `$products`
- اطبع بطاقة المنتج

المشروع يستعمل الحلقات في:

- بطاقات المنتجات
- بطاقات التصنيفات
- جداول لوحة التحكم
- المستخدمين
- الطلبات
- المدفوعات

## 12. الشروط Conditions

الشروط تحدد ماذا نعرض.

مثال:

```php
<?php if ($products): ?>
    <p>Products found</p>
<?php else: ?>
    <p>No products found</p>
<?php endif; ?>
```

في المشروع، الشروط تستعمل من أجل:

- عرض رسالة عندما لا توجد نتائج
- عرض رسائل النجاح أو الخطأ
- إبقاء الفلاتر المختارة
- التحقق من الصلاحيات
- التحقق من حالة المنتج

مثال داخل `select`:

```php
<option value="prix-asc" <?= $sortFilter === 'prix-asc' ? 'selected' : '' ?>>
    Prix croissant
</option>
```

هذا يجعل الاختيار يبقى محددا بعد إعادة تحميل الصفحة.

## 13. CRUD

CRUD تعني:

- Create: إضافة
- Read: قراءة
- Update: تعديل
- Delete: حذف

أمثلة من لوحة الإدارة:

| الخاصية | الجدول |
| --- | --- |
| إدارة المستخدمين | `utilisateur` |
| إدارة المنتجات | `produit` |
| تعديل المخزون | `produit.Stock` |
| تعديل حالة الطلب | `commande.status_com` |
| حذف الدفع | `paiement` |

مثال إضافة:

```php
$stmt = $pdo->prepare('INSERT INTO produit (nom_Prod, Prix) VALUES (:nom, :prix)');
$stmt->execute([
    'nom' => $name,
    'prix' => $price,
]);
```

مثال تعديل:

```php
$stmt = $pdo->prepare('UPDATE produit SET Stock = :stock WHERE ID_Prod = :id');
$stmt->execute([
    'stock' => $stock,
    'id' => $id,
]);
```

مثال حذف:

```php
$stmt = $pdo->prepare('DELETE FROM produit WHERE ID_Prod = :id');
$stmt->execute(['id' => $id]);
```

## 14. إعادة التوجيه Redirect

PHP يمكنها توجيه المستخدم إلى صفحة أخرى بواسطة `header()`.

مثال:

```php
header('Location: ../pages/auth.php');
exit;
```

من المهم استعمال `exit` بعد التوجيه حتى لا تكمل PHP تنفيذ باقي الصفحة.

## 15. تنظيم الملفات

المشروع منظم حسب الدور:

```txt
pages/admin/
pages/producer/
pages/client/
```

كل لوحة تحتوي على:

- navbar
- sidebar
- footer
- sections

مثال:

```txt
pages/admin/sections/users.php
pages/admin/sections/products.php
pages/admin/sections/orders.php
```

هذا التنظيم يجعل المشروع أسهل في الفهم والتعديل.

## 16. قواعد مهمة للمبتدئين

1. استعمل `e()` عند طباعة بيانات داخل HTML.
2. استعمل prepared statements عندما تدخل بيانات المستخدم في SQL.
3. ضع الكود المتكرر داخل helpers أو ملفات include.
4. استعمل sessions لمعرفة المستخدم المتصل.
5. استعمل permissions لحماية لوحات التحكم.
6. خزّن مسارات الصور بشكل نسبي مثل `assets/images/products/savonBeldi.png`.
7. لا تخزن كلمات المرور كنص عادي؛ استعمل `password_hash()`.
8. عند تسجيل الدخول، استعمل `password_verify()`.

## 17. ترتيب مقترح للتعلم

اقرأ ملفات المشروع بهذا الترتيب:

1. `config/database.php`
2. `includes/view_helpers.php`
3. `includes/session.php`
4. `includes/permissions.php`
5. `actions/login.php`
6. `pages/products.php`
7. `pages/categories.php`
8. `pages/admin-dashboard.php`
9. `pages/admin/sections/users.php`
10. `pages/admin/product-controller.php`

بعد قراءة هذه الملفات، ستفهم أغلب بنية المشروع وطريقة عمله.

