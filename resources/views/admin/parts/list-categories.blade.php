@foreach ($categories as $category)
<div class="col">
  <div class="card">
    <div class="row g-0">
      <div class="col-md-4">
        <img src="{{ asset('uploads/' . $category->image) }}" alt="..." class="card-img">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title">{{ $category->name }}</h5>
          <p class="card-text">{{ $category->description }}</p>
          <p class="card-text"><small class="text-muted">{{ $category->parent->name }}</small>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
@endforeach