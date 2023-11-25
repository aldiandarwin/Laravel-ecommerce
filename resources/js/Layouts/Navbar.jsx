import { Link, usePage } from '@inertiajs/react';
import ApplicationLogo from '@/Components/ApplicationLogo';
import NavLink from '@/Components/NavLink';
import Dropdown from '@/Components/Dropdown';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink';
import { useState } from 'react';
import { IconShoppingCart } from '@tabler/icons-react';

export default function Navbar() {
    const { auth } = usePage().props;
    const [showingNavigationDropdown, setShowingNavigationDropdown] = useState(false);
    return (
        <nav className='bg-white border-b border-gray-100'>
            <div className='px-4 mx-auto max-w-7xl sm:px-6 lg:px-8'>
                <div className='flex justify-between h-16'>
                    <div className='flex'>
                        <div className='flex items-center shrink-0'>
                            <Link href='/'>
                                <ApplicationLogo className='block w-auto text-gray-800 fill-current h-9' />
                            </Link>
                        </div>

                        <div className='hidden space-x-8 sm:-my-px sm:ml-10 sm:flex'>
                            <NavLink href={route('products.index')} active={route().current('products.*')}>
                                Products
                            </NavLink>
                        </div>
                    </div>

                    {auth.user ? (
                        <div className='hidden sm:ml-6 sm:flex sm:items-center'>
                            <Link className='flex items-center text-gray-500 gap-x-2' href={route('carts.index')}>
                                <IconShoppingCart className='w-5 h-5 stroke-[1.5]' />
                                <strong className='text-sm font-semibold'>{auth.user.cartCount}</strong>
                            </Link>
                            <div className='relative ml-3'>
                                <Dropdown>
                                    <Dropdown.Trigger>
                                        <span className='inline-flex rounded-md'>
                                            <button
                                                type='button'
                                                className='inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none'>
                                                {auth.user.name}

                                                <svg
                                                    className='-mr-0.5 ml-2 h-4 w-4'
                                                    xmlns='http://www.w3.org/2000/svg'
                                                    viewBox='0 0 20 20'
                                                    fill='currentColor'>
                                                    <path
                                                        fillRule='evenodd'
                                                        d='M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z'
                                                        clipRule='evenodd'
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </Dropdown.Trigger>

                                    <Dropdown.Content>
                                        <Dropdown.Link href={route('dashboard')}>Dashboard</Dropdown.Link>
                                        <Dropdown.Link href={route('profile.edit')}>Profile</Dropdown.Link>
                                        <Dropdown.Link href={route('logout')} method='post' as='button'>
                                            Log Out
                                        </Dropdown.Link>
                                    </Dropdown.Content>
                                </Dropdown>
                            </div>
                        </div>
                    ) : (
                        <div className='hidden space-x-8 sm:-my-px sm:ml-10 sm:flex'>
                            <NavLink href={route('login')} active={route().current('login')}>
                                Login
                            </NavLink>
                            <NavLink href={route('register')} active={route().current('register')}>
                                Register
                            </NavLink>
                        </div>
                    )}

                    <div className='flex items-center -mr-2 sm:hidden'>
                        <button
                            onClick={() => setShowingNavigationDropdown((previousState) => !previousState)}
                            className='inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none'>
                            <svg className='w-6 h-6' stroke='currentColor' fill='none' viewBox='0 0 24 24'>
                                <path
                                    className={!showingNavigationDropdown ? 'inline-flex' : 'hidden'}
                                    strokeLinecap='round'
                                    strokeLinejoin='round'
                                    strokeWidth='2'
                                    d='M4 6h16M4 12h16M4 18h16'
                                />
                                <path
                                    className={showingNavigationDropdown ? 'inline-flex' : 'hidden'}
                                    strokeLinecap='round'
                                    strokeLinejoin='round'
                                    strokeWidth='2'
                                    d='M6 18L18 6M6 6l12 12'
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div className={(showingNavigationDropdown ? 'block' : 'hidden') + ' sm:hidden'}>
                <ResponsiveNavLink href='/' active={false}>
                    Home
                </ResponsiveNavLink>
                {auth.user ? (
                    <>
                        <div className='pt-2 pb-3 space-y-1'>
                            <ResponsiveNavLink href={route('dashboard')} active={route().current('dashboard')}>
                                Dashboard
                            </ResponsiveNavLink>
                        </div>

                        <div className='pt-4 pb-1 border-t border-gray-200'>
                            <div className='px-4'>
                                <div className='text-base font-medium text-gray-800'>{auth.user.name}</div>
                                <div className='text-sm font-medium text-gray-500'>{auth.user.email}</div>
                            </div>

                            <div className='mt-3 space-y-1'>
                                <ResponsiveNavLink href={route('dashboard')}>Dashboard</ResponsiveNavLink>
                                <ResponsiveNavLink href={route('profile.edit')}>Profile</ResponsiveNavLink>
                                <ResponsiveNavLink method='post' href={route('logout')} as='button'>
                                    Log Out
                                </ResponsiveNavLink>
                            </div>
                        </div>
                    </>
                ) : (
                    <>
                        <div className='pt-2 pb-3 space-y-1'>
                            <ResponsiveNavLink href={route('login')} active={route().current('login')}>
                                Login
                            </ResponsiveNavLink>
                            <ResponsiveNavLink href={route('register')} active={route().current('register')}>
                                Register
                            </ResponsiveNavLink>
                        </div>
                    </>
                )}
            </div>
        </nav>
    );
}
