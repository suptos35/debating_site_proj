<x-layout>
    <p>{{$type}}: {{$name}}</p>
    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        <div class="lg:grid lg:grid-cols-3">
            @foreach ($posts as $post)

                <x-post_card :post="$post"></x-post_card>


            @endforeach


        </div>
      </main>
</x-layout>
