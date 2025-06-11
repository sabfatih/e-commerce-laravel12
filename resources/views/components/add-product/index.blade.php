<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>add product</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
  <form action="{{ route('product.store') }}" method="POST" class="flex flex-col gap-4" enctype="multipart/form-data">
      @csrf
      <div class="flex flex-col gap-2">
          <label for="name" class="font-bold">Product Name</label>
          <input type="text" id="name" name="name" required class="border border-gray-300 rounded-md p-2">
          @error('name')
              <span class="text-red-500 text-sm">{{ $message }}</span>
          @enderror
      </div>
      <div class="flex flex-col gap-2">
          <label for="description" class="font-bold">Description</label>
          <textarea id="description" name="description" class="border border-gray-300 rounded-md p-2"></textarea>
          @error('description')
              <span class="text-red-500 text-sm">{{ $message }}</span>
          @enderror
      </div>
      <div class="flex flex-col gap-2">
          <label for="price" class="font-bold">Price</label>
          <input type="number" id="price" name="price" step="0.01" required class="border border-gray-300 rounded-md p-2">
          @error('price')
              <span class="text-red-500 text-sm">{{ $message }}</span>
          @enderror
      </div>
      <div class="flex flex-col gap-2">
          <label for="stock" class="font-bold">Stock</label>
          <input type="number" id="stock" name="stock" required class="border border-gray-300 rounded-md p-2">
          @error('stock')
              <span class="text-red-500 text-sm">{{ $message }}</span>
          @enderror
      </div>
      <div class="flex flex-col gap-2">
          <label for="weight" class="font-bold">Weight</label>
          <input type="number" id="weight" name="weight" step="0.01" required class="border border-gray-300 rounded-md p-2">
          @error('weight')
              <span class="text-red-500 text-sm">{{ $message }}</span>
          @enderror
      </div>
      <div class="flex flex-col gap-2">
          <label for="image" class="font-bold">Product Image</label>
          <input onchange="previewImage(event)" type="file" id="images" name="images[]" multiple accept="image/*" class="border border-gray-300 rounded-md p-2">
          @error('images')
              <span class="text-red-500 text-sm">{{ $message }}</span>
          @enderror
      </div>
      <div id="preview-container" class="flex flex-wrap gap-2 px-2">
        
      </div>
      <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">Add Product</button>
  </form>

<script>

  const previewContainer = document.querySelector("#preview-container");
  
  const previewImage = (e) => {
    if(!e.target.files || !e.target.files[0]) return;

    for (const [index, file] of Array.from(e.target.files).entries()) {
        const container = document.createElement('div');
        container.classList.add('flex', 'flex-col', 'items-center', 'gap-2');

        const img = document.createElement('img');
        img.src = URL.createObjectURL(file);
        img.classList.add('w-40', 'object-cover', 'rounded', 'shadow');

        const input = document.createElement('input');
        input.type = "radio";
        input.name = "isPrimaryRadio";
        input.value = index;
        input.classList.add('peer');

        console.log(file);
        
        const isPrimaryText = document.createElement('span');
        isPrimaryText.id = "primary-" + index;
        isPrimaryText.innerHTML = "Primary";
        isPrimaryText.classList.add('peer-[&:not(:checked)]:hidden', 'text-sm', 'font-semibold', 'text-blue-500', 'dark:text-blue-300');

        container.appendChild(img);
        container.appendChild(input);
        container.appendChild(isPrimaryText);

        previewContainer.appendChild(container);
    }
  }
</script>
</body>
</html>