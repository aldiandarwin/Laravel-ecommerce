export default function ProductBlock({ product }) {
    return (
        <div className='group relative'>
            <div className='min-h-80 aspect-h-1 aspect-w-1 lg:aspect-none w-full overflow-hidden rounded-md bg-gray-200 group-hover:opacity-75 lg:h-80'>
                <img
                    src={product.imageSrc}
                    alt={product.imageAlt}
                    className='h-full w-full object-cover object-center lg:h-full lg:w-full'
                />
            </div>
            <div className='mt-4 flex justify-between'>
                <div>
                    <h3 className='text-sm text-gray-700'>
                        <a href={product.href}>
                            <span aria-hidden='true' className='absolute inset-0' />
                            {product.name}
                        </a>
                    </h3>
                    <p className='mt-1 text-sm text-gray-500'>{product.category?.name}</p>
                </div>
                <p className='text-sm font-medium text-gray-900'>Rp {product.price}</p>
            </div>
        </div>
    );
}
