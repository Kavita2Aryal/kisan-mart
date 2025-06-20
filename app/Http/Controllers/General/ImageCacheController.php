<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\Filesystem;
use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\ServerFactory;
use League\Glide\Signatures\SignatureFactory;
use League\Glide\Signatures\SignatureException;

class ImageCacheController extends Controller
{
    public function render(Filesystem $filesystem, $path)
    {
        try {
            SignatureFactory::create(config('app.config.image_cache.SIGNATURE'))->validateRequest(config('app.config.image_cache.URL') . $path, request()->all());

            $server = ServerFactory::create([
                'response' => new LaravelResponseFactory(app('request')),
                'source' => $filesystem->getDriver(),
                'source_path_prefix' => 'public' . config('app.config.image_cache.PATH'),
                'cache' => $filesystem->getDriver(),
                'cache_path_prefix' => config('app.config.image_cache.CACHE_PATH'),
                'max_image_size' => 2000 * 2000,
                'base_url' => 'image',
                'presets' => [
                    '100X100' => [
                        'w' => 100,
                        'h' => 100,
                        'fit' => 'crop',
                    ],
                    '480X320' => [
                        'w' => 480,
                        'h' => 320,
                        'fit' => 'crop',
                    ],
                    '768' => [
                        'w' => 768,
                        'fit' => 'contain',
                    ],
                    '1024' => [
                        'w' => 1024,
                        'fit' => 'contain',
                    ],
                    '1200' => [
                        'w' => 1200,
                        'fit' => 'contain',
                    ]
                ]
            ]);
            return $server->getImageResponse($path, request()->all());
        } catch (SignatureException $e) {
            abort(403);
        } catch (FileNotFoundException $e) {
            abort(404);
        }
    }

    public function render_section(Filesystem $filesystem, $path)
    {
        try {
            SignatureFactory::create(config('app.config.image_cache.SIGNATURE'))->validateRequest(config('app.config.image_cache.URL_SECTION') . $path, request()->all());

            $server = ServerFactory::create([
                'response' => new LaravelResponseFactory(app('request')),
                'source' => $filesystem->getDriver(),
                'source_path_prefix' => 'public' . config('app.config.image_cache.PATH_SECTION'),
                'cache' => $filesystem->getDriver(),
                'cache_path_prefix' => config('app.config.image_cache.CACHE_PATH'),
                'max_image_size' => 2000 * 2000,
                'base_url' => 'image',
                'presets' => [
                    '768' => [
                        'w' => 768,
                        'fit' => 'contain',
                    ]
                ]
            ]);

            return $server->getImageResponse($path, request()->all());
        } catch (SignatureException $e) {
            abort(403);
        } catch (FileNotFoundException $e) {
            abort(404);
        }
    }

    public function render_ecommerce(Filesystem $filesystem, $path)
    {
        try {
            SignatureFactory::create(config('app.config.image_cache.SIGNATURE'))->validateRequest(config('app.config.image_cache.URL_ECOM') . $path, request()->all());

            $server = ServerFactory::create([
                'response' => new LaravelResponseFactory(app('request')),
                'source' => $filesystem->getDriver(),
                'source_path_prefix' => 'public' . config('app.config.image_cache.PATH_ECOM'),
                'cache' => $filesystem->getDriver(),
                'cache_path_prefix' => config('app.config.image_cache.CACHE_PATH'),
                'max_image_size' => 2000 * 2000,
                'base_url' => 'image',
                'presets' => [
                    '480X320' => [
                        'w' => 480,
                        'h' => 320,
                        'fit' => 'crop',
                    ],
                    '768' => [
                        'w' => 768,
                        'fit' => 'contain',
                    ],
                    '1024' => [
                        'w' => 1024,
                        'fit' => 'contain',
                    ],
                    '1200' => [
                        'w' => 1200,
                        'fit' => 'contain',
                    ]
                ]
            ]);

            return $server->getImageResponse($path, request()->all());
        } catch (SignatureException $e) {
            abort(403);
        } catch (FileNotFoundException $e) {
            abort(404);
        }
    }

    public function render_product(Filesystem $filesystem, $path)
    {
        try {
            SignatureFactory::create(config('app.config.image_cache.SIGNATURE'))->validateRequest(config('app.config.image_cache.URL_PRODUCT') . $path, request()->all());

            $server = ServerFactory::create([
                'response' => new LaravelResponseFactory(app('request')),
                'source' => $filesystem->getDriver(),
                'source_path_prefix' => 'public' . config('app.config.image_cache.PATH_PRODUCT'),
                'cache' => $filesystem->getDriver(),
                'cache_path_prefix' => config('app.config.image_cache.CACHE_PATH'),
                'max_image_size' => 2000 * 2000,
                'base_url' => 'image',
                'presets' => [
                    '480X320' => [
                        'w' => 480,
                        'h' => 320,
                        'fit' => 'crop',
                    ],
                    '768' => [
                        'w' => 768,
                        'fit' => 'contain',
                    ],
                    '1024' => [
                        'w' => 1024,
                        'fit' => 'contain',
                    ],
                    '1200' => [
                        'w' => 1200,
                        'fit' => 'contain',
                    ]
                ]
            ]);

            return $server->getImageResponse($path, request()->all());
        } catch (SignatureException $e) {
            abort(403);
        } catch (FileNotFoundException $e) {
            abort(404);
        }
    }

    public function delete(Filesystem $filesystem, $path)
    {
        if ($path == 'thunder') {
            Storage::deleteDirectory(config('app.config.image_cache.CACHE_PATH'));
        } else {
            $server = ServerFactory::create([
                'cache' => $filesystem->getDriver(),
                'cache_path_prefix' => config('app.config.image_cache.CACHE_PATH'),
            ]);

            $server->deleteCache($path);
        }
    }
}
