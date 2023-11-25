import { Head, usePage } from '@inertiajs/react';
import AppLayout from '@/Layouts/AppLayout';
import Container from '@/Components/Container';
import ProductBlock from '@/Pages/Products/Partials/ProductBlock';
import Pagination from '@/Components/Pagination';

export default function Index({ title }) {
    const { data: products, meta, links } = usePage().props.products;
    return (
        <>
            <Head title={title} />
            <Container>
                <div className='py-8 lg:py-16'>
                    <h2 className='text-2xl font-bold tracking-tight text-gray-900'>Trending Products</h2>

                    <div className='grid grid-cols-1 mt-6 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8'>
                        {products.map((product) => (
                            <ProductBlock product={product} key={product.id} />
                        ))}
                    </div>

                    {meta.has_pages && (
                        <div className='mt-8'>
                            <Pagination links={links} />
                        </div>
                    )}
                </div>
            </Container>
        </>
    );
}

Index.layout = (page) => (
    <AppLayout
        header={<h2 className='text-xl font-semibold leading-tight text-gray-800'>{page.props.title}</h2>}
        children={page}
    />
);
