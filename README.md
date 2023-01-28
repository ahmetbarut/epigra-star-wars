# Açılış

Bu proje, [swapi.dev](https://swapi.dev/) API'si kullanılarak yapılmıştır. Bu API, Star Wars filmlerindeki karakterlerin, türlerin ve araçların listesini içerir.

## Neler Kullanıldı?

Laravel'in yerleşik özellikleri kullanıldı. Bunlar;

1. [Command](https://laravel.com/docs/9.x/artisan)
2. [Migrations](https://laravel.com/docs/9.x/migrations)
3. [Factory](https://laravel.com/docs/9.x/database-testing#writing-factories)
4. [Events](https://laravel.com/docs/9.x/events)
5. [Listeners](https://laravel.com/docs/9.x/events#defining-listeners)
6. [Jobs](https://laravel.com/docs/9.x/queues)
7. [Controllers](https://laravel.com/docs/9.x/controllers)
8. [Sanctum](https://laravel.com/docs/9.x/sanctum)

Genel olarak bunları içerir. Ayrıca API dokümanı burada yer alıyor. [API](https://documenter.getpostman.com/view/12296633/2s935hPRq2)

## API'yi Kullanmadan Önce

### 1. Projeyi çalışma alanınıza klonlayın

```bash
    git clone https://github.com/ahmetbarut/epigra-star-wars.git
```

### 2. Projede gereken paketleri yükleyin

```bash
composer install
npm install
npm run dev
```

### 3. .env dosyasını oluşturun ve veritabanı ayarlarınızı yapın

```bash
cp .env.example .env
```

Bu aşamada kullanacağınız veritabanı ayarlarınızı yapın. Veritabanı ayarlarınızı yaptıktan sonra veritabanını oluşturun.

Daha sonra tabloları kaydedin.

```bash
php artisan migrate
```

### Son olarak

Veriler her 3 dakikada bir güncellenmektedir. Bu işlemi hemen yapmak için aşağıdaki komutu çalıştırın.

```bash
php artisan queue:work database --queues=fetch-people,default

php artisan sync:database-api-data
```

> `database` yerine `QUEUE_CONNECTION` ayarına göre `redis` veya `sync` yazabilirsiniz.

```bash
php artisan serve
```
