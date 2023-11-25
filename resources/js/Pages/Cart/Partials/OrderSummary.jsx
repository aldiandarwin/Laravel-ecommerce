import { usePage } from '@inertiajs/react';

export default function OrderSummary() {
    const { orderSummary } = usePage().props;
    return (
        <section
            aria-labelledby='summary-heading'
            className='px-4 py-6 mt-16 rounded-lg bg-gray-50 sm:p-6 lg:col-span-5 lg:mt-0 lg:p-8'>
            <h2 id='summary-heading' className='text-lg font-medium text-gray-900'>
                Order summary
            </h2>

            <dl className='mt-6 space-y-4'>
                <div className='flex items-center justify-between'>
                    <dt className='text-sm text-gray-600'>Subtotal</dt>
                    <dd className='font-mono text-sm font-medium text-gray-900'>{orderSummary.subtotal}</dd>
                </div>
                <div className='flex items-center justify-between pt-4 border-t border-gray-200'>
                    <dt className='flex text-sm text-gray-600'>
                        <span>PPN</span>
                        <a href='#' className='flex-shrink-0 ml-2 text-gray-400 hover:text-gray-500'>
                            <span className='sr-only'>Learn more about how tax is calculated</span>
                        </a>
                    </dt>
                    <dd className='font-mono text-sm font-medium text-gray-900'>{orderSummary.tax}</dd>
                </div>
                <div className='flex items-center justify-between pt-4 border-t border-gray-200'>
                    <dt className='text-base font-medium text-gray-900'>Order total</dt>
                    <dd className='font-mono text-base font-medium text-gray-900'>Rp {orderSummary.total}</dd>
                </div>
            </dl>

            <div className='mt-6'>
                <button
                    type='submit'
                    className='w-full px-4 py-3 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50'>
                    Checkout
                </button>
            </div>
        </section>
    );
}
