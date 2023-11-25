import { Link, router } from '@inertiajs/react';
import { IconCircleCheckFilled, IconX } from '@tabler/icons-react';

export default function CartBlock({ cart }) {
    function updateQuantity(e, cart) {
        router.put(route('carts.update', [cart]), { quantity: e.target.value }, { preserveScroll: true });
    }

    return (
        <li className='flex py-6 sm:py-10'>
            <div className='flex-shrink-0'>
                <img
                    src={cart.variation.product.imageSrc}
                    alt={cart.variation.product.imageAlt}
                    className='object-cover object-center w-16 h-16 rounded-md lg:h-24 lg:w-24'
                />
            </div>

            <div className='flex flex-col justify-between flex-1 ml-4 sm:ml-6'>
                <div className='relative pr-9 sm:grid sm:grid-cols-2 sm:gap-x-6 sm:pr-0'>
                    <div>
                        <div className='flex justify-between'>
                            <h3 className='text-sm'>
                                <a
                                    href={cart.variation.product.href}
                                    className='font-medium text-gray-700 hover:text-gray-800'>
                                    {cart.variation.product.name}
                                </a>
                            </h3>
                        </div>
                        <div className='flex mt-1 text-sm'>
                            <p className='text-gray-500'>
                                <span>{cart.variation.attribute_1}</span>
                                <span className='mx-2'>/</span>
                                <span>{cart.variation.attribute_2}</span>
                            </p>
                        </div>
                        <p className='mt-1 text-sm font-medium text-gray-900'>Rp {cart.variation.price}</p>
                    </div>

                    <div className='mt-4 sm:mt-0 sm:pr-9'>
                        <label className='sr-only'>Quantity, {cart.variation.product.name}</label>
                        <select
                            onChange={(e) => updateQuantity(e, cart)}
                            value={cart.quantity}
                            className='max-w-full rounded-md border border-gray-300 py-1.5 text-left text-base font-medium leading-5 text-gray-700 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 sm:text-sm'>
                            {Array.from({ length: cart.variation.stock }, (_, i) => i + 1).map((quantity) => (
                                <option key={quantity}>{quantity}</option>
                            ))}
                        </select>

                        <div className='absolute top-0 right-0'>
                            <Link
                                href={route('carts.destroy', [cart])}
                                method='delete'
                                as='button'
                                className='inline-flex p-2 -m-2 text-gray-400 hover:text-gray-500'>
                                <span className='sr-only'>Remove</span>
                                <IconX className='w-5 h-5' aria-hidden='true' />
                            </Link>
                        </div>
                    </div>
                </div>

                <p className='flex mt-4 space-x-2 text-sm text-gray-700'>
                    {cart.variation.inStock ? (
                        <IconCircleCheckFilled className='flex-shrink-0 w-5 h-5 text-green-500' aria-hidden='true' />
                    ) : (
                        <IconCircleCheckFilled className='flex-shrink-0 w-5 h-5 text-orange-500' aria-hidden='true' />
                    )}

                    <span>{cart.variation.inStock ? 'In stock' : `Low stock`}</span>
                </p>
            </div>
        </li>
    );
}
