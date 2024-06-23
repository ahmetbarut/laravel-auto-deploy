@servers(['web' => ['127.0.0.1']])
{{-- see https://laravel.com/docs/master/envoy --}}
@task('foo', ['on' => 'web'])
    ls -la
@endtask
