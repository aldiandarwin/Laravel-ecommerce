import { IconShoppingCartOff } from '@tabler/icons-react';
import { Link } from '@inertiajs/react';

export default function CartEmpty() {
    return (
        <div className='w-full max-w-xl mx-auto sm:pt-32'>
            <div className='flex items-center justify-center w-16 h-16 mx-auto bg-white rounded-full animate-pulse sm:h-24 sm:w-24'>
                <IconShoppingCartOff className='h-8 w-8 stroke-[1.25] sm:h-10 sm:w-10' />
            </div>

            <div className='mt-4 text-center'>
                <h3 className='text-xl font-medium text-gray-900 sm:text-2xl'>Your cart is empty</h3>
                <p className='mt-2 mb-6 text-xl text-gray-500'>
                    Biscuit oat cake wafer icing ice cream tiramisu pudding cupcake.
                </p>

                <Link
                    className='px-6 py-3 text-sm font-medium bg-white rounded-lg shadow hover:shadow-lg'
                    href={route('products.index')}>
                    Go shopping<span aria-hidden='true'> &rarr;</span>
                </Link>
            </div>
        </div>
    );
}
