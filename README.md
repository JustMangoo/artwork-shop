# Art Work Shop

## About The Project

Welcome to the Arti Work E-commerce Platform, a comprehensive website designed specifically for showcasing and selling artist-created artworks. This platform not only presents these works but also simplifies the management of marketing, sales, and transactions, aiming to provide a user-friendly, visually appealing, and functionally robust online store experience.

### Built With

- [Vue.js](https://vuejs.org/)
- [Laravel](https://laravel.com/)
- [Inertia.js](https://inertiajs.com/)

## Getting Started
1. Clone the repo
```
https://github.com/JustMangoo/artwork-shop.git
```

2. Install NPM packages
```
npm install
```

3. Copy the .env.example file to .env and enter your database and other environment-specific details.
```
cp .env.example .env
```

4. Generate your application key
```
php artisan key:generate
```

5. Run migrations and (optional) seeders for initial data
```
php artisan migrate --seed
```

6. Install and compile front-end assets
```
npm run dev  # For development
# or
npm run prod  # For production
```

7. Start the local development
```
php artisan serve
```

```
artwork-shop
├─ .editorconfig
├─ .git
│  ├─ COMMIT_EDITMSG
│  ├─ config
│  ├─ description
│  ├─ FETCH_HEAD
│  ├─ HEAD
│  ├─ hooks
│  │  ├─ applypatch-msg.sample
│  │  ├─ commit-msg.sample
│  │  ├─ fsmonitor-watchman.sample
│  │  ├─ post-update.sample
│  │  ├─ pre-applypatch.sample
│  │  ├─ pre-commit.sample
│  │  ├─ pre-merge-commit.sample
│  │  ├─ pre-push.sample
│  │  ├─ pre-rebase.sample
│  │  ├─ pre-receive.sample
│  │  ├─ prepare-commit-msg.sample
│  │  ├─ push-to-checkout.sample
│  │  └─ update.sample
│  ├─ index
│  ├─ info
│  │  └─ exclude
│  ├─ logs
│  │  ├─ HEAD
│  │  └─ refs
│  │     ├─ heads
│  │     │  └─ master
│  │     └─ remotes
│  │        └─ origin
│  │           └─ master
│  ├─ ORIG_HEAD
│  └─ refs
│     ├─ heads
│     │  └─ master
│     ├─ remotes
│     │  └─ origin
│     │     └─ master
│     └─ tags
├─ .gitattributes
├─ .gitignore
├─ app
│  ├─ Console
│  │  └─ Kernel.php
│  ├─ Exceptions
│  │  └─ Handler.php
│  ├─ Http
│  │  ├─ Controllers
│  │  │  ├─ Auth
│  │  │  │  ├─ AuthenticatedSessionController.php
│  │  │  │  ├─ ConfirmablePasswordController.php
│  │  │  │  ├─ EmailVerificationNotificationController.php
│  │  │  │  ├─ EmailVerificationPromptController.php
│  │  │  │  ├─ NewPasswordController.php
│  │  │  │  ├─ PasswordController.php
│  │  │  │  ├─ PasswordResetLinkController.php
│  │  │  │  ├─ RegisteredUserController.php
│  │  │  │  └─ VerifyEmailController.php
│  │  │  ├─ CartController.php
│  │  │  ├─ CategoryController.php
│  │  │  ├─ ContactController.php
│  │  │  ├─ Controller.php
│  │  │  ├─ DashboardController.php
│  │  │  ├─ ImageController.php
│  │  │  ├─ OrdersController.php
│  │  │  ├─ ProductController.php
│  │  │  ├─ ProfileController.php
│  │  │  ├─ SubscriptionController.php
│  │  │  └─ UserController.php
│  │  ├─ Kernel.php
│  │  ├─ Middleware
│  │  │  ├─ Authenticate.php
│  │  │  ├─ EncryptCookies.php
│  │  │  ├─ HandleInertiaRequests.php
│  │  │  ├─ PreventRequestsDuringMaintenance.php
│  │  │  ├─ RedirectIfAuthenticated.php
│  │  │  ├─ TrimStrings.php
│  │  │  ├─ TrustHosts.php
│  │  │  ├─ TrustProxies.php
│  │  │  ├─ ValidateSignature.php
│  │  │  └─ VerifyCsrfToken.php
│  │  └─ Requests
│  │     ├─ Auth
│  │     │  └─ LoginRequest.php
│  │     └─ ProfileUpdateRequest.php
│  ├─ Mail
│  │  ├─ ContactFormMail.php
│  │  ├─ MyEmail.php
│  │  └─ NewsletterSubscription.php
│  ├─ Models
│  │  ├─ Cart.php
│  │  ├─ CartItem.php
│  │  ├─ Category.php
│  │  ├─ Image.php
│  │  ├─ Order.php
│  │  ├─ Product.php
│  │  ├─ Role.php
│  │  ├─ Subscription.php
│  │  └─ User.php
│  └─ Providers
│     ├─ AppServiceProvider.php
│     ├─ AuthServiceProvider.php
│     ├─ BroadcastServiceProvider.php
│     ├─ EventServiceProvider.php
│     └─ RouteServiceProvider.php
├─ artisan
├─ bootstrap
│  ├─ app.php
│  └─ cache
│     ├─ .gitignore
│     ├─ packages.php
│     ├─ routes-v7.php
│     └─ services.php
├─ composer.json
├─ composer.lock
├─ config
│  ├─ app.php
│  ├─ auth.php
│  ├─ broadcasting.php
│  ├─ cache.php
│  ├─ cors.php
│  ├─ database.php
│  ├─ filesystems.php
│  ├─ hashing.php
│  ├─ logging.php
│  ├─ mail.php
│  ├─ queue.php
│  ├─ sanctum.php
│  ├─ services.php
│  ├─ session.php
│  └─ view.php
├─ database
│  ├─ .gitignore
│  ├─ factories
│  │  └─ UserFactory.php
│  ├─ migrations
│  │  ├─ 2013_03_25_114755_create_roles_table.php
│  │  ├─ 2014_10_12_000000_create_users_table.php
│  │  ├─ 2014_10_12_100000_create_password_reset_tokens_table.php
│  │  ├─ 2019_08_19_000000_create_failed_jobs_table.php
│  │  ├─ 2019_12_14_000001_create_personal_access_tokens_table.php
│  │  ├─ 2024_02_07_202331_create_categories_table.php
│  │  ├─ 2024_02_07_202332_create_products_table.php
│  │  ├─ 2024_02_07_202333_create_images_table.php
│  │  ├─ 2024_04_03_175339_create_subscriptions_table.php
│  │  ├─ 2024_04_10_182830_create_carts_table.php
│  │  ├─ 2024_04_11_182830_create_cart_items_table.php
│  │  └─ 2024_05_19_193240_create_orders_table.php
│  └─ seeders
│     ├─ CategorySeeder.php
│     ├─ DatabaseSeeder.php
│     ├─ ImageSeeder.php
│     ├─ ProductSeeder.php
│     └─ RolesTableSeeder.php
├─ Daugats_dokumentacija.docx
├─ jsconfig.json
├─ lang
│  ├─ en
│  │  ├─ auth.php
│  │  ├─ pagination.php
│  │  ├─ passwords.php
│  │  └─ validation.php
│  └─ lv
│     ├─ auth.php
│     ├─ pagination.php
│     ├─ passwords.php
│     └─ validation.php
├─ package-lock.json
├─ package.json
├─ phpunit.xml
├─ postcss.config.js
├─ public
│  ├─ .htaccess
│  ├─ favicon.ico
│  ├─ index.php
│  └─ robots.txt
├─ README.md
├─ resources
│  ├─ css
│  │  └─ app.css
│  ├─ js
│  │  ├─ app.js
│  │  ├─ Assets
│  │  │  ├─ arrow.svg
│  │  │  ├─ brush-strokes
│  │  │  │  └─ brush-stroke-1.svg
│  │  │  ├─ cart.svg
│  │  │  ├─ check.svg
│  │  │  ├─ icons
│  │  │  │  ├─ latvia-flag.svg
│  │  │  │  └─ uk-flag.svg
│  │  │  ├─ Images
│  │  │  │  ├─ Artis-port.jpg
│  │  │  │  ├─ Email-img
│  │  │  │  │  ├─ image-1.png
│  │  │  │  │  ├─ image-2.png
│  │  │  │  │  ├─ image-3.png
│  │  │  │  │  ├─ image-4.png
│  │  │  │  │  ├─ image-5.png
│  │  │  │  │  └─ image-6.jpeg
│  │  │  │  ├─ foto1.webp
│  │  │  │  ├─ foto2.webp
│  │  │  │  ├─ foto3.png
│  │  │  │  ├─ Image1.png
│  │  │  │  ├─ Image2.png
│  │  │  │  ├─ Image3.png
│  │  │  │  ├─ Image4.png
│  │  │  │  ├─ Image5.png
│  │  │  │  └─ logo.svg
│  │  │  ├─ list-white.svg
│  │  │  ├─ location.svg
│  │  │  ├─ mail-white.svg
│  │  │  ├─ mail.svg
│  │  │  ├─ pen.svg
│  │  │  ├─ phone.svg
│  │  │  ├─ plus.svg
│  │  │  ├─ search.svg
│  │  │  ├─ socials
│  │  │  │  ├─ facebook.svg
│  │  │  │  ├─ instagram.svg
│  │  │  │  └─ tiktok.svg
│  │  │  ├─ trash.svg
│  │  │  ├─ upload.svg
│  │  │  ├─ user-white.svg
│  │  │  ├─ user.svg
│  │  │  └─ xmark.svg
│  │  ├─ bootstrap.js
│  │  ├─ Components
│  │  │  ├─ ApplicationLogo.vue
│  │  │  ├─ CarouselHero.vue
│  │  │  ├─ Checkbox.vue
│  │  │  ├─ DangerButton.vue
│  │  │  ├─ Dropdown.vue
│  │  │  ├─ DropdownLink.vue
│  │  │  ├─ FooterSection.vue
│  │  │  ├─ FooterSectionAdmin.vue
│  │  │  ├─ ImageUploadComponent.vue
│  │  │  ├─ InputError.vue
│  │  │  ├─ InputLabel.vue
│  │  │  ├─ Modal.vue
│  │  │  ├─ Navigation.vue
│  │  │  ├─ NavLink.vue
│  │  │  ├─ PrimaryButton.vue
│  │  │  ├─ ResponsiveNavLink.vue
│  │  │  ├─ SecondaryButton.vue
│  │  │  └─ SystemMessage.vue
│  │  ├─ Layouts
│  │  │  ├─ AdminLayout.vue
│  │  │  ├─ AuthenticatedLayout.vue
│  │  │  ├─ FormModalLayout.vue
│  │  │  └─ MainLayout.vue
│  │  └─ Pages
│  │     ├─ About.vue
│  │     ├─ Admin
│  │     │  ├─ Dashboard.vue
│  │     │  ├─ Orders
│  │     │  │  └─ Index.vue
│  │     │  ├─ Products
│  │     │  │  └─ Index.vue
│  │     │  └─ Users
│  │     │     └─ Index.vue
│  │     ├─ Auth
│  │     │  ├─ ConfirmPassword.vue
│  │     │  ├─ ForgotPassword.vue
│  │     │  ├─ Login.vue
│  │     │  ├─ Register.vue
│  │     │  ├─ ResetPassword.vue
│  │     │  └─ VerifyEmail.vue
│  │     ├─ Home.vue
│  │     ├─ Original.vue
│  │     ├─ Printed.vue
│  │     ├─ ProductDetails.vue
│  │     ├─ Products.vue
│  │     ├─ Profile
│  │     │  ├─ Edit.vue
│  │     │  └─ Partials
│  │     │     ├─ DeleteUserForm.vue
│  │     │     ├─ UpdatePasswordForm.vue
│  │     │     └─ UpdateProfileInformationForm.vue
│  │     ├─ TestArea.vue
│  │     ├─ User
│  │     │  ├─ CartSidebar.vue
│  │     │  ├─ CheckoutCancel.vue
│  │     │  └─ CheckoutSuccess.vue
│  │     └─ Woodwork.vue
│  └─ views
│     ├─ app.blade.php
│     └─ mail
│        ├─ contact-form.blade.php
│        ├─ index.html
│        ├─ newsletter-join.blade.php
│        └─ test-email.blade.php
├─ routes
│  ├─ api.php
│  ├─ auth.php
│  ├─ channels.php
│  ├─ console.php
│  └─ web.php
├─ storage
│  ├─ app
│  │  ├─ .gitignore
│  │  └─ public
│  │     ├─ .gitignore
│  │     └─ products
│  │        ├─ cb7haejW8tmRPFpFhrox4F0aIrwp0izjWtlNKj78.png
│  │        ├─ DP6e1nrCWjpUGTKWzwmIN6BzmRxWb1ahDFz0VBXz.png
│  │        ├─ gCcJ2s3uODhjEzmWKStatHGgT7UIQFM6usB1qOen.svg
│  │        └─ sIkrY8V4jF11sWkfFeYydOvcyscf9WcebLTqa7a6.jpg
│  ├─ framework
│  │  ├─ .gitignore
│  │  ├─ cache
│  │  │  ├─ .gitignore
│  │  │  └─ data
│  │  │     └─ .gitignore
│  │  ├─ sessions
│  │  │  ├─ .gitignore
│  │  │  ├─ 6hsWWq7W7kKzqWNKRQoL3RQVq7rHMhHG424ScdE6
│  │  │  ├─ iioDjRHdGYGIuRWyOR4CWcvcNg1qJIHRFzxOuxyv
│  │  │  └─ tuPINRiaPSCmP61A4u1YlO6vNoLc0ceMRHXviV7m
│  │  ├─ testing
│  │  │  └─ .gitignore
│  │  └─ views
│  │     ├─ .gitignore
│  │     ├─ 02c3df2f67ac4021d4bbd5f56c9d30ca.php
│  │     ├─ 07bfb106c3a39df4549af18d8af4bcce.php
│  │     ├─ 0c4ab460c71b0ab6848a64166aad1e01.php
│  │     ├─ 1269713601d2a3a5ee45f5756e2316c3.php
│  │     ├─ 4ac1397d8eda4e3937b1932b5f08928e.php
│  │     ├─ 4d5cdcb126afd3fecd12760c0fc66525.php
│  │     ├─ 513f39ebbcff989aea2c4f51f87103ec.php
│  │     ├─ 5aada43d3cb8ca4a974a0d0683307f21.php
│  │     ├─ 5dbe5b85d5bedf06205d47c49c015d26.php
│  │     ├─ 61e2847425fdfb73305a27878e885b39.php
│  │     ├─ 73195c9bd52e71535a555b5516412a71.php
│  │     ├─ 7b69b3a2c1d016f48f7db9a19b591691.php
│  │     ├─ 9816305ba89b3e82a13288884b3be1e6.php
│  │     ├─ 99db2a4986ab80b21785a0063eeae067.php
│  │     ├─ b43ed9b8c9067763bc9c1ccbd14d7a5b.php
│  │     ├─ b645ecf61a9de7560a202de4312100a0.php
│  │     ├─ cf8892507e169c1901d7df84d91be696.php
│  │     ├─ db887faf0d0d3a60dc673c077ebc73dc.php
│  │     └─ e0140c121b5c36bff81afd9ec94622d9.php
│  └─ logs
│     ├─ .gitignore
│     └─ laravel.log
├─ tailwind.config.js
├─ tests
│  ├─ CreatesApplication.php
│  ├─ Feature
│  │  ├─ Auth
│  │  │  ├─ AuthenticationTest.php
│  │  │  ├─ EmailVerificationTest.php
│  │  │  ├─ PasswordConfirmationTest.php
│  │  │  ├─ PasswordResetTest.php
│  │  │  ├─ PasswordUpdateTest.php
│  │  │  └─ RegistrationTest.php
│  │  ├─ ExampleTest.php
│  │  └─ ProfileTest.php
│  ├─ TestCase.php
│  └─ Unit
│     └─ ExampleTest.php
└─ vite.config.js

```