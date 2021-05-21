<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->initSerializers();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * инициализация сериалайзеров
     */
    public function initSerializers()
    {
        $serializerInitClosure = function () {
            //Энкодеры для преобразования даных в понятний формат(array|object)
            $encoders = [
                new JsonEncoder(),
            ];

            //нормалайзеры - класы которые отвечають за преобразования одного типа в другой
            // Должно реализовывать:
            //Symfony\Component\Serializer\Normalizer\SerializerAwareInterface,
            //Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface,
            //Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface
            //Symfony\Component\Serializer\Normalizer\NormalizerInterface
            $normalizers = [
                new ObjectNormalizer(),
                new ArrayDenormalizer(),
            ];

            return new Serializer($normalizers, $encoders);
        };

        $this->app->singleton(SerializerInterface::class, $serializerInitClosure);
        $this->app->singleton(NormalizerInterface::class, $serializerInitClosure);
    }
}
