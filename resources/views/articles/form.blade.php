<div class="card-body">
        <form action="" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input
                    type="text"
                    class="form-control @error('title') is-invalid @enderror"
                    name="title"
                    value="{{ isset($article) ? old('title',$article->title) : old('title')}}"
                >
                @error('title')
                    <div class="invalid-feedback">{{ $errors->first('title')}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="title">Body</label>
                <textarea
                    name="body" id="body" cols="20" rows="10"
                    class="form-control @error('body') is-invalid @enderror">{{ isset($article) ? old('body',$article->body) : old('body')}}
                </textarea>
                @error('body')
                    <div class="invalid-feedback">{{ $errors->first('body')}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="title">Categories</label>
                <select name="categories[]" id="" class="form-control" multiple>
                    @foreach ($categories as $id => $name)
                        <option
                            value="{{ $id }}"
                            @if(isset($article) && $article->categories->contains($id))
                                selected
                            @endif>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="published">Published?</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="published" value="1"
                        {{ isset($article) && $article->published==1 ? 'checked' : ''}}>
                    <label class="form-check-label">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="published" value="0"
                        {{ isset($article) && $article->published==0 ? 'checked' : ''}}  >
                    <label class="form-check-label">No</label>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('articles:index')}}" class="btn btn-link">Cancel</a>
            </div>
        </form>
    </div>
