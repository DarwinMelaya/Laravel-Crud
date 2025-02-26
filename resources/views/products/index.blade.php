<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Management</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
</head>
<body class="bg-[#F9FAFB]">
    <div class="container mx-auto p-6 sm:p-8">
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-[#008000]">Products</h1>
                <p class="mt-1 text-sm text-gray-500">Manage your product inventory and details</p>
            </div>
            
            <a href="{{ route('product.create') }}" 
               class="bg-[#008000] hover:bg-[#006400] text-white font-medium py-2 px-4 rounded-lg shadow-sm hover:shadow transition duration-150 inline-flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Product
            </a>
        </div>

        <!-- Success Message -->
        @if(session()->has('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span class="font-medium">{{ session()->get('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Table Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <!-- Table Header -->
            <div class="border-b border-gray-200 px-6 py-4 flex items-center justify-between">
                <h2 class="font-semibold text-gray-800">All Products</h2>
                <div class="flex items-center gap-2">
                    <span class="text-gray-500 text-sm">Total Products: {{ $products->count() }}</span>
                </div>
            </div>

            <!-- Table Content -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-50">
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product Details</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Inventory</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($products as $product)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                            <div class="text-sm text-gray-500 truncate max-w-xs">{{ $product->type }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($product->qty > 10)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            In Stock ({{ $product->qty }})
                                        </span>
                                    @elseif($product->qty > 0)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            Low Stock ({{ $product->qty }})
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Out of Stock
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">₱{{ number_format($product->price, 2) }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Active
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('product.edit', ['product' => $product->id]) }}" 
                                           class="text-white bg-yellow-500 hover:bg-yellow-600 p-2 rounded-lg transition-colors duration-200">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                            </svg>
                                        </a>
                                        <form method="post" action="{{route('product.destroy', ['product' => $product->id])}}" class="inline">
                                            @csrf
                                            @method('delete')
                                            <button type="button" 
                                                    onclick="openDeleteModal({{ $product->id }}, '{{ $product->name }}')"
                                                    class="text-white bg-red-500 hover:bg-red-600 p-2 rounded-lg transition-colors duration-200">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 backdrop-blur-sm bg-black/50 hidden overflow-y-auto h-full w-full transition-opacity duration-300">
        <div class="relative top-1/2 -translate-y-1/2 mx-auto p-6 border-0 w-[480px] shadow-2xl rounded-2xl bg-white transform transition-all duration-300">
            <div class="text-center">
                <!-- Warning Icon -->
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-6">
                    <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                
                <!-- Content -->
                <h3 class="text-xl leading-6 font-semibold text-gray-900 mb-2">Delete Product</h3>
                <div class="mt-2 px-1">
                    <p class="text-gray-600">Are you sure you want to delete <span id="productName" class="font-semibold text-gray-900"></span>?</p>
                    <p class="text-sm text-gray-500 mt-1">This action cannot be undone.</p>
                </div>

                <!-- Buttons -->
                <div class="flex justify-center gap-3 mt-8">
                    <button id="cancelButton" class="flex-1 max-w-[160px] px-5 py-2.5 bg-gray-50 hover:bg-gray-100 text-gray-700 text-sm font-medium rounded-lg border border-gray-300 transition-colors duration-200">
                        Cancel
                    </button>
                    <button id="confirmButton" class="flex-1 max-w-[160px] px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors duration-200 flex items-center justify-center">
                        <span class="inline-flex items-center">
                            <svg id="loadingIcon" class="hidden animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span id="buttonText">Delete Product</span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openDeleteModal(productId, productName) {
            const modal = document.getElementById('deleteModal');
            const productNameSpan = document.getElementById('productName');
            const confirmButton = document.getElementById('confirmButton');
            const cancelButton = document.getElementById('cancelButton');
            const loadingIcon = document.getElementById('loadingIcon');
            const buttonText = document.getElementById('buttonText');
            
            modal.classList.remove('hidden');
            productNameSpan.textContent = productName;
            
            // Reset button state
            confirmButton.disabled = false;
            loadingIcon.classList.add('hidden');
            buttonText.textContent = 'Delete Product';
            
            confirmButton.onclick = function() {
                // Show loading state
                confirmButton.disabled = true;
                loadingIcon.classList.remove('hidden');
                buttonText.textContent = 'Deleting...';
                
                // Find the specific form for this product using the product ID
                const form = document.querySelector(`form[action*="${productId}"]`);
                if (form) {
                    form.submit();
                }
            }
            
            cancelButton.onclick = function() {
                modal.classList.add('hidden');
            }
            
            // Close modal when clicking outside
            modal.onclick = function(e) {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                }
            }
        }
    </script>
</body>
</html>