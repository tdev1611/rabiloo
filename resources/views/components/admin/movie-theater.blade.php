<div class="mb-3 col-md-5">
    <label for="movie_id" class="form-label"> Movies </label>
    <select class="form-select form-select-lg mb-3" aria-label="Large select example" name="movie_id" id="movie_id">
        <option value=""  >
           Choose a Movie
        </option>
        @foreach ($movies as $movie)
            <option value="{{ $movie->id }}" >
                {{ $movie->name }}
            </option>
        @endforeach


    </select>
</div>
<div class="mb-3 col-md-5">
    <label for="theater_id" class="form-label"> Theaters </label>
    <select class="form-select form-select-lg mb-3" aria-label="Large select example" name="theater_id" id="theater_id">
        <option value=""  >
            Choose a Theater
         </option>
        @foreach ($theaters as $theater)
            <option value="{{ $theater->id }}"   >
                {{ $theater->name }}
            </option>
        @endforeach
    </select>
</div>